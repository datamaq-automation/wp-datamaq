<?php

namespace DataMaq\Infrastructure\WordPress;

use DataMaq\Domain\Chat\BotEngine;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

/**
 * Clase ChatRestController
 *
 * Registra y gestiona el endpoint REST para el chatbot.
 */
class ChatRestController {

	private BotEngine $bot_engine;
	private string $namespace = 'datamaq/v1';
	private string $rest_base = 'chat';

	public function __construct( BotEngine $bot_engine ) {
		$this->bot_engine = $bot_engine;
	}

	/**
	 * Registra las rutas de la API REST.
	 */
	public function register_routes(): void {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'handle_request' ),
					'permission_callback' => '__return_true', // Permitir acceso público al chat
				),
			)
		);
	}

	/**
	 * Maneja la petición entrante del chat.
	 *
	 * @param WP_REST_Request $request Objeto de la petición.
	 * @return void
	 */
	public function handle_request( WP_REST_Request $request ): void {
		// BotMan maneja su propia salida (headers y body), 
		// por lo que simplemente llamamos a listen().
		$this->bot_engine->listen();
		exit; // BotMan termina el proceso por nosotros
	}
}
