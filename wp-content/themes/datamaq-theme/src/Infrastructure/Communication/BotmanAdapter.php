<?php

namespace DataMaq\Infrastructure\Communication;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Drivers\HttpDriver;
use BotMan\BotMan\Messages\Incoming\Answer;
use DataMaq\Domain\Communication\ChatProvider;
use DataMaq\Domain\Chat\BotEngine;
use DataMaq\Domain\Shared\ConfigProvider;
use DataMaq\Domain\Shared\Observability\LoggerInterface;

/**
 * Adapter para la integración con BotMan.
 * Implementa tanto la interfaz de visualización (ChatProvider) como la de ejecución (BotEngine).
 */
class BotmanAdapter implements ChatProvider, BotEngine {

	private ConfigProvider $config;
	private LoggerInterface $logger;
	private \DataMaq\Domain\Chat\ChatbotService $chatbot_service;
	private ?BotMan $botman = null;

	public function __construct( ConfigProvider $config, LoggerInterface $logger, \DataMaq\Domain\Chat\ChatbotService $chatbot_service ) {
		$this->config          = $config;
		$this->logger          = $logger;
		$this->chatbot_service = $chatbot_service;
	}

	public function getIdentifier(): string {
		return 'botman';
	}

	public function isEnabled(): bool {
		return $this->config->isEnabled( 'botman' );
	}

	/**
	 * Inicializa el motor de BotMan.
	 */
	private function initBotman(): void {
		if ( null !== $this->botman ) {
			return;
		}

		// Cargar el driver Web
		DriverManager::loadDriver( \BotMan\Drivers\Web\WebDriver::class );

		$config = array(
			'conversation_cache_time' => 40,
			'user_cache_time'         => 30,
		);

		$this->botman = BotManFactory::create( $config );
		$this->setupRules();
	}

	/**
	 * Define las reglas de conversación.
	 */
	public function setupRules(): void {
		if ( null === $this->botman ) {
			return;
		}

		// Registrar reglas desde el dominio
		foreach ( $this->chatbot_service->getStaticRules() as $pattern => $response ) {
			$this->botman->hears( $pattern, function( BotMan $bot ) use ( $response ) {
				$bot->reply( $response );
			} );
		}

		// Registrar flujos interactivos (Conversations)
		$this->botman->hears( 'contacto|presupuesto|comprar|cotizar|asesor', function( BotMan $bot ) {
			$bot->startConversation( new \DataMaq\Infrastructure\Communication\Conversations\LeadCaptureConversation() );
		} );

		// Fallback desde el dominio
		$fallback = $this->chatbot_service->getFallbackMessage();
		$this->botman->fallback( function( BotMan $bot ) use ( $fallback ) {
			$bot->reply( $fallback );
		} );
	}

	/**
	 * Procesa la petición entrante.
	 */
	public function listen(): void {
		try {
			$this->initBotman();
			$this->botman->listen();
		} catch ( \Exception $e ) {
			$this->logger->error( 'Error en BotMan listen: ' . $e->getMessage() );
		}
	}

	public function renderWidget(): void {
		if ( ! $this->isEnabled() ) {
			return;
		}

		$this->logger->info( 'Rendering Botman native widget UI.' );
		?>
		<!-- BotMan Chat Widget -->
		<div id="dm-chatbot" class="tw:fixed tw:bottom-6 tw:right-6 tw:z-[9999]">
			<!-- Ventana de Chat (Oculta por defecto) -->
			<div id="dm-chat-container" class="tw:hidden tw:bg-white tw:shadow-2xl tw:rounded-2xl tw:w-80 tw:md:w-96 tw:h-[500px] tw:flex tw:flex-col tw:border tw:border-dm-border tw:mb-4 tw:overflow-hidden">
				<div class="tw:bg-dm-primary tw:p-4 tw:text-white tw:font-bold tw:flex tw:justify-between tw:items-center">
					<span>Asistente DataMaq</span>
					<button id="dm-chat-close" class="tw:text-white/80 hover:tw:text-white">×</button>
				</div>
				<div id="dm-chat-messages" class="tw:flex-1 tw:p-4 tw:overflow-y-auto tw:bg-dm-surface-50">
					<div class="tw:bg-dm-surface-200 tw:p-3 tw:rounded-lg tw:max-w-[80%] tw:mr-auto tw:mb-3">
						¡Hola! 👋 Soy tu asistente. ¿Cómo puedo ayudarte hoy?
					</div>
				</div>
				<form id="dm-chat-form" class="tw:p-3 tw:border-t tw:bg-white tw:flex tw:gap-2">
					<input type="text" id="dm-chat-input" placeholder="Escribe tu mensaje..." class="tw:flex-1 tw:border tw:border-dm-border tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm focus:tw:outline-none focus:tw:border-dm-primary">
					<button type="submit" class="tw:bg-dm-primary tw:text-white tw:p-2 tw:rounded-lg hover:tw:bg-dm-primary-dark">
						<i class="bi bi-send"></i>
					</button>
				</form>
			</div>

			<!-- Botón Flotante -->
			<button id="dm-chat-toggle" class="tw:bg-dm-primary tw:text-white tw:w-14 tw:h-14 tw:rounded-full tw:shadow-lg tw:flex tw:items-center tw:justify-center tw:transition-transform hover:tw:scale-110 active:tw:scale-95">
				<i class="bi bi-chat-dots-fill tw:text-2xl"></i>
			</button>
		</div>
		<?php
	}
}
