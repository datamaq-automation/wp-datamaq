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
		// TODO: Implement ChatWoot API call
		$this->logger->info( 'Attempting to save lead to ChatWoot: ' . $lead->getName() );
		$this->logger->info( 'Config check (Base URL): ' . $this->config->get('datamaq_chatwoot_base_url', 'N/A') );
		return true; // Temporary return
	}
}
