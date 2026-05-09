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
 * Puente unificado para la captura de leads.
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
	public function create_lead( WP_REST_Request $request ): WP_REST_Response {
		$params   = $request->get_params();
		$trace_id = $request->get_header( 'X-DataMaq-Trace-ID' ) ?? $params['trace_id'] ?? 'legacy-' . uniqid();
		
		// Registro de trazabilidad (Observabilidad)
		\DataMaq\Domain\Shared\Observability\TraceContext::set( $trace_id );

		error_log( \DataMaq\Domain\Shared\Observability\TraceContext::format( "📥 Incoming Lead Request. Raw params: " . json_encode( $params ) ) );

		// Mapeo flexible para soportar el formato de la SPA
		$name      = $params['name'] ?? $params['nombre'] ?? '';
		$firstName = $params['first_name'] ?? '';
		$lastName  = $params['last_name'] ?? '';
		$email     = $params['email'] ?? ( $params['custom_attributes']['email'] ?? '' );
		$phone     = $params['phone'] ?? $params['telefono'] ?? ( $params['custom_attributes']['phone'] ?? '' );
		$message   = $params['message'] ?? $params['mensaje'] ?? '';
		$company   = $params['company'] ?? $params['empresa'] ?? ( $params['custom_attributes']['company'] ?? '' );
		$channel   = $params['preferred_contact_channel'] ?? 'contact-spa';

		error_log( "[DataMaq Debug] [$trace_id] Normalized: Name=$name, Email=$email, Phone=$phone, Channel=$channel" );

		if ( empty( $name ) || ( empty( $email ) && empty( $phone ) ) ) {
			error_log( "[DataMaq Error] [$trace_id] ⚠️ Validation Failed: Missing required data. Name: '{$name}', Email: '{$email}', Phone: '{$phone}'" );
			error_log( \DataMaq\Domain\Shared\Observability\TraceContext::format( "⚠️ Validation Failed: Missing required data. Name: '{$name}', Email: '{$email}', Phone: '{$phone}'" ) );
			return new WP_REST_Response( array( 
				'success' => false, 
				'message' => 'Faltan datos obligatorios (nombre y al menos un contacto).' 
			), 400 );
		}

		error_log( \DataMaq\Domain\Shared\Observability\TraceContext::format( "Normalized: Name=$name, Email=$email, Phone=$phone, Channel=$channel" ) );

		try {
			// Usar el nuevo constructor DDD de LeadEntity
			$lead = new \DataMaq\Domain\Lead\LeadEntity( $name, $email, $phone, $params );
			
			error_log( \DataMaq\Domain\Shared\Observability\TraceContext::format( "Executing SubmitLeadUseCase..." ) );
			$success = $this->use_case->execute( $lead );

			if ( $success ) {
				error_log( \DataMaq\Domain\Shared\Observability\TraceContext::format( "✅ Lead successfully processed and synced." ) );
				return new WP_REST_Response( array( 'success' => true, 'id' => 'chatwoot_synced' ), 200 );
			} else {
				error_log( \DataMaq\Domain\Shared\Observability\TraceContext::format( "❌ Failure in SubmitLeadUseCase for lead: $email / $phone" ) );
				return new WP_REST_Response( array( 
					'success' => false, 
					'message' => 'Error al persistir en ChatWoot.' 
				), 500 );
			}
		} catch ( \Exception $e ) {
			error_log( \DataMaq\Domain\Shared\Observability\TraceContext::format( "❌ Exception in Lead Sync: " . $e->getMessage() ) );
			return new WP_REST_Response( array( 
				'success' => false, 
				'message' => 'Error al persistir en ChatWoot.' 
			), 500 );
		}
	}

}
