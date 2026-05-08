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
use DataMaq\Domain\Shared\Logger;

/**
 * Adapter para la integración con BotMan.
 * Implementa tanto la interfaz de visualización (ChatProvider) como la de ejecución (BotEngine).
 */
class BotmanAdapter implements ChatProvider, BotEngine {

	private ConfigProvider $config;
	private Logger $logger;
	private ?BotMan $botman = null;

	public function __construct( ConfigProvider $config, Logger $logger ) {
		$this->config = $config;
		$this->logger = $logger;
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

		// Respuesta simple de saludo
		$this->botman->hears( 'hola|buen(as|os) (dias|tardes|noches)', function( BotMan $bot ) {
			$bot->reply( '¡Hola! Soy el asistente virtual de DataMaq. ¿En qué puedo ayudarte hoy?' );
		} );

		// Fallback para mensajes no entendidos
		$this->botman->fallback( function( BotMan $bot ) {
			$bot->reply( 'Lo siento, todavía estoy aprendiendo. Puedes preguntarme sobre nuestros cursos o servicios.' );
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

		$this->logger->info( 'Rendering Botman native widget.' );
		
		// En el futuro, aquí inyectaremos el React Chat Widget.
		// Por ahora, un placeholder para testing.
		?>
		<div id="datamaq-chat-root"></div>
		<script>
			console.log('DataMaq: Botman UI Engine ready.');
			// Aquí irá la lógica de conexión con el endpoint /wp-json/datamaq/v1/chat
		</script>
		<?php
	}
}
