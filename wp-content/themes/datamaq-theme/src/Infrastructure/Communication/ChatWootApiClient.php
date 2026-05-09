<?php

namespace DataMaq\Infrastructure\Communication;

use DataMaq\Domain\Shared\Observability\LoggerInterface;
use DataMaq\Domain\Shared\Observability\TraceContext;

/**
 * ChatWootApiClient (Infrastructure)
 * 
 * Cliente de bajo nivel para la API de Chatwoot.
 * Sigue el principio de Responsabilidad Única.
 */
class ChatWootApiClient {
	private string $baseUrl;
	private string $accessToken;
	private string $accountId;
	private LoggerInterface $logger;

	public function __construct( string $baseUrl, string $accessToken, string $accountId, LoggerInterface $logger ) {
		$this->baseUrl     = rtrim( $baseUrl, '/' );
		$this->accessToken = $accessToken;
		$this->accountId   = $accountId;
		$this->logger      = $logger;
	}

	public function request( string $method, string $endpoint, array $data = array() ) {
		$url = sprintf( '%s/api/v1/accounts/%s/%s', $this->baseUrl, $this->accountId, ltrim( $endpoint, '/' ) );
		
		$args = array(
			'method'  => $method,
			'headers' => array(
				'api_access_token' => $this->accessToken,
				'Content-Type'     => 'application/json',
			),
			'timeout' => 15,
		);

		if ( ! empty( $data ) ) {
			$args['body'] = json_encode( $data );
		}

		$response = wp_remote_request( $url, $args );
		$code     = wp_remote_retrieve_response_code( $response );

		if ( is_wp_error( $response ) ) {
			$this->logger->error( TraceContext::format( "Chatwoot API Request Failed: " . $response->get_error_message() ) );
			return null;
		}

		if ( $code < 200 || $code >= 300 ) {
			$this->logger->error( TraceContext::format( "Chatwoot API Error [{$code}]: " . wp_remote_retrieve_body( $response ) ) );
			return null;
		}

		return json_decode( wp_remote_retrieve_body( $response ), true );
	}
}
