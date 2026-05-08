<?php

namespace DataMaq\Infrastructure\Shared;

use DataMaq\Domain\Shared\Health\HealthRepositoryInterface;
use DataMaq\Domain\Shared\Observability\LoggerInterface;

/**
 * Adaptador para verificar servicios vía HTTP.
 */
class ExternalHealthAdapter implements HealthRepositoryInterface {

	private LoggerInterface $logger;
	private array $endpoints;

	public function __construct( LoggerInterface $logger ) {
		$this->logger = $logger;
		$this->endpoints = array(
			'orchestrator' => 'https://api.datamaq.com.ar/v1/health',
		);
	}

	public function checkStatus( string $service_key ): array {
		if ( ! isset( $this->endpoints[ $service_key ] ) ) {
			return array( 'status' => 'unknown', 'message' => 'Service not configured' );
		}

		$start_time = microtime( true );
		$response   = wp_remote_get( $this->endpoints[ $service_key ], array( 'timeout' => 5 ) );
		$latency    = round( ( microtime( true ) - $start_time ) * 1000, 2 );

		if ( is_wp_error( $response ) ) {
			$this->logger->error( "Health check failed for $service_key", array( 
				'error' => $response->get_error_message(),
				'latency' => $latency
			) );
			return array( 'status' => 'down', 'message' => $response->get_error_message(), 'latency' => $latency );
		}

		$code = wp_remote_retrieve_response_code( $response );

		if ( 200 !== $code ) {
			$this->logger->warning( "Service $service_key returned non-200 code", array( 
				'code' => $code,
				'latency' => $latency
			) );
			return array( 'status' => 'unstable', 'message' => "HTTP Code $code", 'latency' => $latency );
		}

		return array( 'status' => 'ok', 'message' => 'Service operational', 'latency' => $latency );
	}
}
