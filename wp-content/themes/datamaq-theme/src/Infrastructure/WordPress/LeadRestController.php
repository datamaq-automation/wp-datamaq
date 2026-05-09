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
	private \DataMaq\Domain\Shared\ConfigProvider $config;
	private string $namespace = 'datamaq/v1';
	private string $rest_base = 'lead';

	public function __construct( SubmitLeadUseCase $use_case, \DataMaq\Domain\Shared\ConfigProvider $config ) {
		$this->use_case = $use_case;
		$this->config   = $config;
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
					'callback'            => array( $this, 'create_lead' ),
					'permission_callback' => array( $this, 'validate_request' ),
				),
			)
		);
	}

	/**
	 * Valida que la petición venga de una fuente autorizada.
	 */
	public function validate_request( WP_REST_Request $request ): bool {
		// En desarrollo local o si no hay secreto definido, permitir (con precaución)
		$secret = $this->config->get( 'DATAMAQ_APP_SECRET' );
		if ( empty( $secret ) ) {
			return true; 
		}

		$provided_secret = $request->get_header( 'X-DataMaq-Secret' );
		return hash_equals( $secret, (string) $provided_secret );
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

		// Mapeo flexible para soportar el formato de la SPA
		$name      = $params['name'] ?? $params['nombre'] ?? '';
		$firstName = $params['first_name'] ?? '';
		$lastName  = $params['last_name'] ?? '';
		$email     = $params['email'] ?? ( $params['custom_attributes']['email'] ?? '' );
		$phone     = $params['phone'] ?? $params['telefono'] ?? ( $params['custom_attributes']['phone'] ?? '' );
		$message   = $params['message'] ?? $params['mensaje'] ?? '';
		$company   = $params['company'] ?? $params['empresa'] ?? ( $params['custom_attributes']['company'] ?? '' );
		$channel   = $params['preferred_contact_channel'] ?? 'contact-spa';


		if ( empty( $name ) || ( empty( $email ) && empty( $phone ) ) ) {
			return new WP_REST_Response( array( 
				'success' => false, 
				'message' => 'Faltan datos obligatorios (nombre y al menos un contacto).' 
			), 400 );
		}

		// Aplanar metadatos para evitar anidamiento en Chatwoot (DDD: Preparación de datos)
		$metadata = array(
			'company'            => $company,
			'description'        => $message,
			'channel'            => $channel,
			'whatsapp_preferred' => ( $channel === 'whatsapp' ), // Transformación a booleano
			'source'             => 'WordPress SPA',
		);

		try {
			// Usar el nuevo constructor DDD de LeadEntity con metadatos planos
			$lead = new \DataMaq\Domain\Lead\LeadEntity( $name, $email, $phone, $metadata );
			
			$success = $this->use_case->execute( $lead );

			if ( $success ) {
				return new WP_REST_Response( array( 'success' => true, 'id' => 'chatwoot_synced' ), 200 );
			} else {
				return new WP_REST_Response( array( 
					'success' => false, 
					'message' => 'Error al persistir en ChatWoot.' 
				), 500 );
			}
		} catch ( \Exception $e ) {
			return new WP_REST_Response( array( 
				'success' => false, 
				'message' => 'Error al persistir en ChatWoot.' 
			), 500 );
		}
	}

}
