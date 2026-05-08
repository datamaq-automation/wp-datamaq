<?php

namespace DataMaq\Infrastructure\Communication\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

/**
 * Conversación para captura de Leads (Nombre, Contacto, Motivo).
 */
class LeadCaptureConversation extends Conversation {

	protected string $name;
	protected string $contact_info;
	protected string $reason;

	/**
	 * Inicia la conversación preguntando el nombre.
	 */
	public function askName(): void {
		$this->ask( '¡Hola! Para brindarte una mejor atención, ¿me podrías decir tu nombre?', function( Answer $answer ) {
			$this->name = $answer->getText();
			$this->say( '¡Un gusto saludarte, ' . $this->name . '!' );
			$this->askContactInfo();
		} );
	}

	/**
	 * Pregunta por un teléfono o email.
	 */
	public function askContactInfo(): void {
		$this->ask( '¿Cuál es tu número de WhatsApp o correo electrónico para que podamos contactarte?', function( Answer $answer ) {
			$this->contact_info = $answer->getText();
			$this->askReason();
		} );
	}

	/**
	 * Pregunta por el motivo de la consulta.
	 */
	public function askReason(): void {
		$this->ask( 'Perfecto. Por último, ¿en qué producto o servicio estás interesado? (Ej: Máquina CNC, Soporte Técnico, Cursos)', function( Answer $answer ) {
			$this->reason = $answer->getText();
			$this->say( '¡Excelente! He registrado tu solicitud.' );
			$this->say( 'Un especialista de DataMaq se contactará contigo a la brevedad a través de: ' . $this->contact_info . '.' );
			
			// Aquí en el futuro dispararemos el Webhook a n8n.
			$this->dispatchToN8n();
		} );
	}

	/**
	 * Simulación del envío de datos a n8n.
	 */
	protected function dispatchToN8n(): void {
		// TODO: Integrar con el servicio HTTP de n8n usando la URL de ConfigProvider.
		// En este punto tenemos $this->name, $this->contact_info y $this->reason.
	}

	/**
	 * Método principal que ejecuta BotMan al iniciar la conversación.
	 */
	public function run(): void {
		$this->askName();
	}
}
