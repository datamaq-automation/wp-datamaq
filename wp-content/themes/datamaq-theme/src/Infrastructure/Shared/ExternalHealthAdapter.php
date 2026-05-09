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
		// Migrado de n8n/orchestrator a Chatwoot Health
		$this->endpoints = array(
			'chatwoot' => 'https://chatwoot.datamaq.com.ar/health',
		);
	}


	public function checkStatus( string $service_key ): \DataMaq\Domain\Shared\Health\HealthStatus {
		if ( ! isset( $this->endpoints[ $service_key ] ) ) {
			return new \DataMaq\Domain\Shared\Health\HealthStatus( 'unknown', 'Service not configured', 0 );
		}

		$start_time = microtime( true );
		$response   = wp_remote_get( $this->endpoints[ $service_key ], array( 'timeout' => 5 ) );
		$latency    = round( ( microtime( true ) - $start_time ) * 1000, 2 );

		if ( is_wp_error( $response ) ) {
			$this->logger->error( "Health check failed for $service_key", array( 
				'error' => $response->get_error_message(),
				'latency' => $latency
			) );
			return new \DataMaq\Domain\Shared\Health\HealthStatus( 'down', $response->get_error_message(), $latency );
		}

		$code = wp_remote_retrieve_response_code( $response );

		if ( 200 !== $code ) {
			$this->logger->warning( "Service $service_key returned non-200 code", array( 
				'code' => $code,
				'latency' => $latency
			) );
			return new \DataMaq\Domain\Shared\Health\HealthStatus( 'unstable', "HTTP Code $code", $latency );
		}

		return new \DataMaq\Domain\Shared\Health\HealthStatus( 'ok', 'Service operational', $latency );
	}
}
