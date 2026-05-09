<?php

namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;
use DataMaq\Domain\Shared\ConfigProvider;
use DataMaq\Domain\Shared\Observability\LoggerInterface;
use DataMaq\Domain\Shared\Observability\TraceContext;
use DataMaq\Infrastructure\Communication\ChatWootApiClient;

/**
 * ChatWootLeadRepository (Infrastructure Adapter)
 * 
 * Implementación del repositorio de leads para Chatwoot siguiendo SOLID y Arquitectura Hexagonal.
 */
class ChatWootLeadRepository implements LeadRepositoryInterface {

	private ConfigProvider $config;
	private LoggerInterface $logger;
	private ?ChatWootApiClient $client = null;

	public function __construct( ConfigProvider $config, LoggerInterface $logger ) {
		$this->config = $config;
		$this->logger = $logger;
	}

	private function getClient(): ?ChatWootApiClient {
		if ( null === $this->client ) {
			$baseUrl     = $this->config->get( 'CHATWOOT_BASE_URL' );
			$accessToken = $this->config->get( 'CHATWOOT_ACCESS_TOKEN' );
			$accountId   = $this->config->get( 'CHATWOOT_ACCOUNT_ID' );

			if ( ! $baseUrl || ! $accessToken || ! $accountId ) {
				$this->logger->error( TraceContext::format( "Chatwoot Configuration Missing" ) );
				return null;
			}

			$this->client = new ChatWootApiClient( $baseUrl, $accessToken, $accountId, $this->logger );
		}
		return $this->client;
	}

	public function save( LeadEntity $lead ): bool {
		$this->logger->info( TraceContext::format( "Syncing lead: " . ( $lead->getEmail() ?: $lead->getPhone() ) ) );

		$client = $this->getClient();
		if ( ! $client ) return false;

		// 1. Resolve Contact
		$contactId = $this->resolveContact( $client, $lead );
		if ( ! $contactId ) return false;

		// 2. Resolve Conversation
		$inboxId = (int) $this->config->get( 'CHATWOOT_INBOX_ID' );
		$conversationId = $this->resolveConversation( $client, $contactId, $inboxId );
		if ( ! $conversationId ) return false;

		// 3. Send Lead Data as Note (Compatible with Website Inboxes)
		return $this->sendLeadData( $client, $conversationId, $lead );
	}

	private function resolveContact( ChatWootApiClient $client, LeadEntity $lead ): ?int {
		$query = $lead->getEmail() ?: $lead->getPhone();
		$search = $client->request( 'GET', "contacts/search?q={$query}" );

		if ( ! empty( $search['payload'] ) ) {
			return (int) $search['payload'][0]['id'];
		}

		// Create if not found
		$create = $client->request( 'POST', 'contacts', array(
			'name'         => $lead->getName(),
			'email'        => $lead->getEmail(),
			'phone_number' => $lead->getPhone(),
			'custom_attributes' => array(
				'source'    => 'WordPress-Gateway',
				'trace_id'  => TraceContext::get(),
				'synced_at' => current_time( 'mysql' )
			)
		) );

		return $create ? (int) $create['payload']['contact']['id'] : null;
	}

	private function resolveConversation( ChatWootApiClient $client, int $contactId, int $inboxId ): ?int {
		$conv = $client->request( 'POST', 'conversations', array(
			'contact_id' => $contactId,
			'inbox_id'   => $inboxId,
			'status'     => 'open'
		) );

		return $conv ? (int) $conv['id'] : null;
	}

	private function sendLeadData( ChatWootApiClient $client, int $conversationId, LeadEntity $lead ): bool {
		$message = "📬 **Nuevo Lead Capturado**\n\n";
		$message .= "👤 **Nombre:** " . $lead->getName() . "\n";
		$message .= "✉️ **Email:** " . ( $lead->getEmail() ?: 'N/A' ) . "\n";
		$message .= "📞 **Teléfono:** " . ( $lead->getPhone() ?: 'N/A' ) . "\n";
		
		$meta = $lead->getMetadata();
		if ( ! empty( $meta['message'] ) ) {
			$message .= "\n💬 **Mensaje:**\n" . $meta['message'];
		}

		// Enviamos como MENSAJE PRIVADO (Nota) para evitar el error de "Website Inbox"
		$response = $client->request( 'POST', "conversations/{$conversationId}/messages", array(
			'content'      => $message,
			'message_type' => 'outgoing', // 'outgoing' es permitido por agentes, 'incoming' falla en Website inboxes
			'private'      => true        // Enviarlo como nota interna
		) );

		if ( $response ) {
			$this->logger->info( TraceContext::format( "Lead successfully synced to Chatwoot." ) );
			return true;
		}

		return false;
	}
}
