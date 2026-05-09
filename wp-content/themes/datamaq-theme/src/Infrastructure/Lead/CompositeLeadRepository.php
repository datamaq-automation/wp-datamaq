<?php

namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;

/**
 * Permite enviar el lead a múltiples repositorios (ej. CRM + n8n).
 */
class CompositeLeadRepository implements LeadRepositoryInterface {

	/** @var LeadRepositoryInterface[] */
	private array $repositories;

	public function __construct( array $repositories ) {
		$this->repositories = $repositories;
	}

	public function save( LeadEntity $lead ): bool {
		$all_success = true;
		foreach ( $this->repositories as $repository ) {
			if ( ! $repository->save( $lead ) ) {
				$all_success = false;
			}
		}
		return $all_success;
	}
}
