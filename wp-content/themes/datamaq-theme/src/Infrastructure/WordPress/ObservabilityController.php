<?php

namespace DataMaq\Infrastructure\WordPress;

use DataMaq\Domain\Shared\Health\HealthRepositoryInterface;
use DataMaq\Domain\Shared\Observability\LoggerInterface;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;

class ObservabilityController extends WP_REST_Controller {

	private LoggerInterface $logger;
	private HealthRepositoryInterface $health_repo;

	public function __construct( LoggerInterface $logger, HealthRepositoryInterface $health_repo ) {
		$this->namespace   = 'datamaq/v1';
		$this->rest_base   = 'observability';
		$this->logger      = $logger;
		$this->health_repo = $health_repo;
	}

	public function register_routes() {
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/health', array(
			'methods'             => 'GET',
			'callback'            => array( $this, 'get_health' ),
			'permission_callback' => '__return_true',
		) );

		register_rest_route( $this->namespace, '/' . $this->rest_base . '/log', array(
			'methods'             => 'POST',
			'callback'            => array( $this, 'post_log' ),
			'permission_callback' => '__return_true', // En prod, limitar por nonce
		) );
	}

	public function get_health( WP_REST_Request $request ): WP_REST_Response {
		$status = $this->health_repo->checkStatus( 'orchestrator' );
		return new WP_REST_Response( $status, 200 );
	}

	public function post_log( WP_REST_Request $request ): WP_REST_Response {
		$level   = $request->get_param( 'level' ) ?? 'info';
		$message = $request->get_param( 'message' ) ?? 'Empty JS log';
		$context = $request->get_param( 'context' ) ?? array();

		switch ( $level ) {
			case 'error':
				$this->logger->error( "[JS] $message", $context );
				break;
			case 'warning':
				$this->logger->warning( "[JS] $message", $context );
				break;
			default:
				$this->logger->info( "[JS] $message", $context );
		}

		return new WP_REST_Response( array( 'received' => true ), 200 );
	}
}
