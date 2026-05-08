<?php

namespace DataMaq\Infrastructure\CRM;

use DataMaq\Domain\CRM\CrmProviderInterface;

/**
 * Servicio de integración directa con SuiteCRM v8 usando Guzzle o cURL nativo.
 */
class SuiteCrmService implements CrmProviderInterface {

	private string $base_url;
	private string $client_id;
	private string $client_secret;
	private string $username;
	private string $password;
	private ?string $token = null;

	/**
	 * Constructor. Las credenciales se inyectan idealmente desde un ConfigProvider.
	 */
	public function __construct( string $base_url, string $client_id, string $client_secret, string $username, string $password ) {
		$this->base_url      = rtrim( $base_url, '/' );
		$this->client_id     = $client_id;
		$this->client_secret = $client_secret;
		$this->username      = $username;
		$this->password      = $password;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createLead( string $name, string $contact_info, string $reason ): bool {
		if ( ! $this->authenticate() ) {
			return false;
		}

		$payload = wp_json_encode(
			array(
				'data' => array(
					'type'       => 'Leads',
					'attributes' => array(
						'first_name'  => $name,
						'last_name'   => 'Lead BotMan',
						'phone_work'  => $contact_info,
						'description' => 'Motivo de contacto: ' . $reason,
						'lead_source' => 'Web Site',
					),
				),
			)
		);

		$response = wp_remote_post(
			$this->base_url . '/Api/V8/module',
			array(
				'headers' => array(
					'Content-Type'  => 'application/vnd.api+json',
					'Accept'        => 'application/vnd.api+json',
					'Authorization' => 'Bearer ' . $this->token,
				),
				'body'    => $payload,
				'timeout' => 5, // Timeout estricto para no colgar el chatbot
			)
		);

		if ( is_wp_error( $response ) ) {
			error_log( 'SuiteCRM API Error (Create Lead): ' . $response->get_error_message() );
			return false;
		}

		$code = wp_remote_retrieve_response_code( $response );
		if ( 201 !== $code ) {
			error_log( 'SuiteCRM API Error (Create Lead HTTP ' . $code . '): ' . wp_remote_retrieve_body( $response ) );
			return false;
		}

		return true;
	}

	/**
	 * Obtiene el token JWT usando el flujo de Password Grant.
	 */
	private function authenticate(): bool {
		// Evitar re-autenticar si ya tenemos token en esta ejecución
		if ( null !== $this->token ) {
			return true;
		}

		$payload = wp_json_encode(
			array(
				'grant_type'    => 'password',
				'client_id'     => $this->client_id,
				'client_secret' => $this->client_secret,
				'username'      => $this->username,
				'password'      => $this->password,
			)
		);

		$response = wp_remote_post(
			$this->base_url . '/Api/access_token',
			array(
				'headers' => array(
					'Content-Type' => 'application/vnd.api+json',
					'Accept'       => 'application/vnd.api+json',
				),
				'body'    => $payload,
				'timeout' => 5,
			)
		);

		if ( is_wp_error( $response ) ) {
			error_log( 'SuiteCRM Auth Error: ' . $response->get_error_message() );
			return false;
		}

		$code = wp_remote_retrieve_response_code( $response );
		$body = wp_remote_retrieve_body( $response );

		if ( 200 !== $code ) {
			error_log( 'SuiteCRM Auth Error HTTP ' . $code . ': ' . $body );
			return false;
		}

		$data = json_decode( $body, true );
		if ( isset( $data['access_token'] ) ) {
			$this->token = $data['access_token'];
			return true;
		}

		return false;
	}

}
