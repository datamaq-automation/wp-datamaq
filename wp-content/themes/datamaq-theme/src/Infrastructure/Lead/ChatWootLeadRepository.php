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
		$this->logger->info( TraceContext::format( "Syncing lead contact: " . ( $lead->getEmail() ?: $lead->getPhone() ) ) );

		$client = $this->getClient();
		if ( ! $client ) return false;

		// Resolve/Create/Update Contact with all lead data
		$contactId = $this->resolveContact( $client, $lead );
		
		if ( $contactId ) {
			$this->logger->info( TraceContext::format( "✅ Contact synced successfully: ID {$contactId}" ) );
			return true;
		}

		return false;
	}


	private function resolveContact( ChatWootApiClient $client, LeadEntity $lead ): ?int {
		$query = $lead->getEmail() ?: $lead->getPhone();
		$search = $client->request( 'GET', "contacts/search?q={$query}" );
		
		$contactData = array(
			'name'         => $lead->getName(),
			'email'        => $lead->getEmail(),
			'phone_number' => $lead->getPhone(),
			'custom_attributes' => array_merge( $lead->getMetadata(), array(
				'last_source'   => 'WordPress-Lead-Form',
				'last_trace_id' => TraceContext::get(),
				'last_sync_at'  => current_time( 'mysql' )
			) )
		);

		if ( ! empty( $search['payload'] ) ) {
			$id = (int) $search['payload'][0]['id'];
			// Update existing contact to ensure latest lead data is persisted
			$client->request( 'PUT', "contacts/{$id}", $contactData );
			return $id;
		}

		// Create if not found
		$create = $client->request( 'POST', 'contacts', $contactData );

		return $create ? (int) $create['payload']['contact']['id'] : null;
	}


}
