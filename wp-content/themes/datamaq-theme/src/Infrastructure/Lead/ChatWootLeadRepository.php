<?php
namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;
use DataMaq\Domain\Shared\ConfigProvider;
use DataMaq\Domain\Shared\Observability\LoggerInterface;

/**
 * ChatWoot implementation for Lead delivery.
 */
class ChatWootLeadRepository implements LeadRepositoryInterface {
	private ConfigProvider $config;
	private LoggerInterface $logger;

	public function __construct( ConfigProvider $config, LoggerInterface $logger ) {
		$this->config = $config;
		$this->logger = $logger;
	}

	public function save( LeadEntity $lead ): bool {
		$account_id = $this->config->get( 'CHATWOOT_ACCOUNT_ID' );
		$base_url   = $this->config->get( 'CHATWOOT_BASE_URL' );
		$token      = $this->config->get( 'CHATWOOT_ACCESS_TOKEN' );
		$inbox_id   = $this->config->get( 'CHATWOOT_INBOX_ID' );

		$this->logger->info( sprintf( '[Chatwoot] Initiating lead sync for %s', $lead->getEmail() ) );

		if ( ! $account_id || ! $base_url || ! $token || ! $inbox_id ) {
			$this->logger->error( '[Chatwoot] CRITICAL: Configuration missing in .env' );
			return false;
		}

		$headers = array(
			'api_access_token' => $token,
			'Content-Type'     => 'application/json',
		);

		// 1. Search or Create Contact
		$this->logger->info( '[Chatwoot] Step 1: Searching for contact...' );
		$contact_id = $this->get_or_create_contact( $lead, $base_url, $account_id, $headers );
		if ( ! $contact_id ) {
			$this->logger->error( '[Chatwoot] Failed to resolve contact ID.' );
			return false;
		}
		$this->logger->info( sprintf( '[Chatwoot] Contact resolved: ID %d', $contact_id ) );

		// 2. Create Conversation
		$this->logger->info( '[Chatwoot] Step 2: Creating conversation...' );
		$conversation_id = $this->create_conversation( $contact_id, $inbox_id, $base_url, $account_id, $headers );
		if ( ! $conversation_id ) {
			$this->logger->error( '[Chatwoot] Failed to create conversation.' );
			return false;
		}
		$this->logger->info( sprintf( '[Chatwoot] Conversation created: ID %d', $conversation_id ) );

		// 3. Send Message
		$this->logger->info( '[Chatwoot] Step 3: Sending lead message...' );
		$success = $this->send_message( $conversation_id, $lead->toArray()['message'], $base_url, $account_id, $headers );
		
		if ( $success ) {
			$this->logger->info( '[Chatwoot] ✅ Lead successfully synced to Chatwoot.' );
		} else {
			$this->logger->error( '[Chatwoot] ❌ Failed to send final message to conversation.' );
		}

		return $success;
	}

	private function get_or_create_contact( LeadEntity $lead, string $base_url, string $account_id, array $headers ): ?int {
		$search_url = sprintf( '%s/api/v1/accounts/%s/contacts/search?q=%s', $base_url, $account_id, $lead->getEmail() );
		$response   = wp_remote_get( $search_url, array( 'headers' => $headers ) );

		if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
			$body = json_decode( wp_remote_retrieve_body( $response ), true );
			if ( ! empty( $body['payload'] ) ) {
				$this->logger->info( '[Chatwoot] Contact found in Chatwoot.' );
				return $body['payload'][0]['id'];
			}
		}

		$this->logger->info( '[Chatwoot] Contact not found. Creating new contact...' );
		$create_url = sprintf( '%s/api/v1/accounts/%s/contacts', $base_url, $account_id );
		$payload    = array(
			'name'         => $lead->getName(),
			'email'        => $lead->getEmail(),
			'phone_number' => $lead->getPhone(),
			'custom_attributes' => array(
				'source' => 'WordPress Website',
			),
		);

		$response = wp_remote_post(
			$create_url,
			array(
				'headers' => $headers,
				'body'    => json_encode( $payload ),
			)
		);

		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
			$error_msg = is_wp_error( $response ) ? $response->get_error_message() : wp_remote_retrieve_body( $response );
			$this->logger->error( '[Chatwoot] Contact creation failed: ' . $error_msg );
			return null;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );
		return $body['payload']['contact']['id'] ?? null;
	}

	private function create_conversation( int $contact_id, int $inbox_id, string $base_url, string $account_id, array $headers ): ?int {
		$url     = sprintf( '%s/api/v1/accounts/%s/conversations', $base_url, $account_id );
		$payload = array(
			'contact_id' => $contact_id,
			'inbox_id'   => $inbox_id,
			'status'     => 'open',
		);

		$response = wp_remote_post(
			$url,
			array(
				'headers' => $headers,
				'body'    => json_encode( $payload ),
			)
		);

		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
			$error_msg = is_wp_error( $response ) ? $response->get_error_message() : wp_remote_retrieve_body( $response );
			$this->logger->error( '[Chatwoot] Conversation creation failed: ' . $error_msg );
			return null;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );
		return $body['id'] ?? null;
	}

	private function send_message( int $conversation_id, string $message, string $base_url, string $account_id, array $headers ): bool {
		$url     = sprintf( '%s/api/v1/accounts/%s/conversations/%s/messages', $base_url, $account_id, $conversation_id );
		$payload = array(
			'content'      => "Nuevo Lead desde la Web:\n\n" . $message,
			'message_type' => 'incoming',
		);

		$response = wp_remote_post(
			$url,
			array(
				'headers' => $headers,
				'body'    => json_encode( $payload ),
			)
		);

		$success = ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200;
		if ( ! $success && ! is_wp_error( $response ) ) {
			$this->logger->error( '[Chatwoot] Message API error: ' . wp_remote_retrieve_body( $response ) );
		}
		
		return $success;
	}
}
