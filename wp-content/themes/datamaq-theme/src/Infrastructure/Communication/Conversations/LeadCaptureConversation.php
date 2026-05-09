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
			
			// Aquí disparamos el envío directo al CRM.
			$this->dispatchToCrm();
		} );
	}

	/**
	 * Envío de datos al ecosistema de persistencia vía Use Case.
	 */
	protected function dispatchToCrm(): void {
		$use_case = dm_submit_lead_use_case();
		
		// Determinamos si es email o teléfono lo que proporcionó
		$email = str_contains( $this->contact_info, '@' ) ? $this->contact_info : '';
		$phone = empty( $email ) ? $this->contact_info : '';

		$name_parts = explode( ' ', trim( $this->name ), 2 );
		$firstName  = $name_parts[0];
		$lastName   = $name_parts[1] ?? '';

		$lead = new \DataMaq\Domain\Lead\LeadEntity(
			$this->name,
			$email,
			'', // Empresa (no solicitada en chat simplificado)
			$this->reason,
			'botman',
			$phone,
			$firstName,
			$lastName
		);

		$success = $use_case->execute( $lead );

		if ( $success ) {
			$this->say( '✅ Tu solicitud fue registrada con éxito en nuestro sistema.' );
		} else {
			$this->say( '⚠️ Hubo un pequeño problema técnico al registrar tu solicitud, pero de todas formas nos pondremos en contacto contigo pronto.' );
		}
	}

	/**
	 * Método principal que ejecuta BotMan al iniciar la conversación.
	 */
	public function run(): void {
		$this->askName();
	}
}
