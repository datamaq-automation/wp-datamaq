<?php

namespace DataMaq\Infrastructure\WordPress;

use DataMaq\Application\Lead\SubmitLeadUseCase;
use DataMaq\Domain\Lead\LeadEntity;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

/**
 * LeadRestController
 * 
 * Endpoint para recibir leads desde la SPA o integraciones externas.
 * Reemplaza funcionalmente al webhook de n8n.
 */
class LeadRestController {

	private SubmitLeadUseCase $use_case;
	private string $namespace = 'datamaq/v1';
	private string $rest_base = 'lead';

	public function __construct( SubmitLeadUseCase $use_case ) {
		$this->use_case = $use_case;
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
					'callback'            => array( $this, 'handle_lead' ),
					'permission_callback' => '__return_true', // Permitir envíos públicos
				),
			)
		);
	}

	/**
	 * Maneja la petición de creación de lead.
	 *
	 * @param WP_REST_Request $request Objeto de la petición.
	 * @return WP_REST_Response
	 */
	public function handle_lead( WP_REST_Request $request ): WP_REST_Response {
		$params = $request->get_json_params();

		// Mapeo flexible para soportar el formato de la SPA (que iba a n8n)
		$name    = $params['name'] ?? $params['nombre'] ?? '';
		$email   = $params['email'] ?? '';
		$phone   = $params['phone'] ?? $params['telefono'] ?? '';
		$message = $params['message'] ?? $params['mensaje'] ?? '';
		$company = $params['company'] ?? $params['empresa'] ?? '';

		if ( empty( $name ) || ( empty( $email ) && empty( $phone ) ) ) {
			return new WP_REST_Response( array( 
				'success' => false, 
				'message' => 'Faltan datos obligatorios (nombre y al menos un contacto).' 
			), 400 );
		}

		$lead = new LeadEntity( $name, $email, $phone, 'contact-spa' );
		
		$success = $this->use_case->execute( $lead, array(
			'message' => $message,
			'company' => $company,
			'source'  => 'SPA Intercepted',
			'raw'     => $params,
		) );

		if ( $success ) {
			return new WP_REST_Response( array( 'success' => true, 'id' => 'crm_synced' ), 200 );
		}

		return new WP_REST_Response( array( 
			'success' => false, 
			'message' => 'Error al persistir en SuiteCRM.' 
		), 500 );
	}
}
