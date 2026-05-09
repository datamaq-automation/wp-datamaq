<?php
namespace DataMaq\Domain\Lead;

interface LeadLogRepositoryInterface {
	/**
	 * Registra un intento de envío de lead.
	 */
	public function log( LeadEntity $lead, bool $success ): void;

	/**
	 * Obtiene los últimos logs.
	 */
	public function getLastLogs( int $limit = 20 ): array;
}
