<?php
namespace DataMaq\Application\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;
use DataMaq\Domain\Lead\LeadLogRepositoryInterface;

class SubmitLeadUseCase {
	private LeadRepositoryInterface $repository;
	private ?LeadLogRepositoryInterface $logger_repo;

	public function __construct( LeadRepositoryInterface $repository, ?LeadLogRepositoryInterface $logger_repo = null ) {
		$this->repository  = $repository;
		$this->logger_repo = $logger_repo;
	}

	public function execute( LeadEntity $lead ): bool {
		// 1. Logic: Send to CRM (Chatwoot)
		$external_sent = $this->repository->save( $lead );

		// 2. Logic: Log for Observability
		if ( $this->logger_repo ) {
			$this->logger_repo->log( $lead, $external_sent );
		}

		// 3. Logic: Send internal notification (Email)
		$this->sendNotification( $lead );

		return $external_sent;
	}

	private function sendNotification( LeadEntity $lead ): bool {
		$to      = get_option( 'admin_email' );
		$subject = 'Nuevo Lead DataMaq: ' . $lead->getName();
		$data    = $lead->toArray();

		$message = "Nuevo contacto desde el Wizard:\n\n" .
					'Nombre: ' . $lead->getName() . "\n" .
					'Email: ' . $lead->getEmail() . "\n" .
					'Empresa: ' . ( $data['company'] ?? '-' ) . "\n" .
					'Canal: ' . ( $data['channel'] ?? 'email' ) . "\n\n" .
					"Mensaje:\n" . ( $data['message'] ?? '-' );

		return wp_mail( $to, $subject, $message );
	}
}
