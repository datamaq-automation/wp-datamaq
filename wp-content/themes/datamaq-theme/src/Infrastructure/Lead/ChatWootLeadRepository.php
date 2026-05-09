<?php
namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;
use DataMaq\Domain\Shared\ConfigProvider;
use DataMaq\Domain\Shared\Logger;

/**
 * ChatWoot implementation for Lead delivery.
 */
class ChatWootLeadRepository implements LeadRepositoryInterface {
	private ConfigProvider $config;
	private Logger $logger;

	public function __construct( ConfigProvider $config, Logger $logger ) {
		$this->config = $config;
		$this->logger = $logger;
	}

	public function save( LeadEntity $lead ): bool {
		// TODO: Implement ChatWoot API call
		// 1. Create/Update Contact
		// 2. Open Conversation
		// 3. Send Message
		$this->logger->info( 'Attempting to save lead to ChatWoot: ' . $lead->getName() );
		return true; // Temporary return
	}
}
