<?php

namespace DataMaq\Infrastructure\WordPress;

use DataMaq\Infrastructure\Shared\WPConfigProvider;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

/**
 * ConfigRestController
 * 
 * Expone la configuración pública necesaria para el frontend.
 */
class ConfigRestController {

	private WPConfigProvider $config_provider;
	private string $namespace = 'datamaq/v1';
	private string $rest_base = 'config';

	public function __construct( WPConfigProvider $config_provider ) {
		$this->config_provider = $config_provider;
	}

	public function register_routes(): void {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_config' ),
					'permission_callback' => '__return_true',
				),
			)
		);
	}

	public function get_config( WP_REST_Request $request ): WP_REST_Response {
		return new WP_REST_Response( array(
			'baseUrl'      => $this->config_provider->get( 'CHATWOOT_BASE_URL' ),
			'websiteToken' => $this->config_provider->get( 'CHATWOOT_WEBSITE_TOKEN' ),
			'traceId'      => \DataMaq\Domain\Shared\Observability\TraceContext::get(),
		), 200 );
	}
}
