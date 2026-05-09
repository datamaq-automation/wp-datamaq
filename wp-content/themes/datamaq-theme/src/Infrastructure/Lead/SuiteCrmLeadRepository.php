<?php

namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;
use DataMaq\Infrastructure\CRM\SuiteCrmService;

/**
 * Adaptador para usar SuiteCRM como repositorio de Leads.
 */
class SuiteCrmLeadRepository implements LeadRepositoryInterface {

	private SuiteCrmService $crm_service;

	public function __construct( SuiteCrmService $crm_service ) {
		$this->crm_service = $crm_service;
	}

	/**
	 * Mapea la entidad Lead a la llamada de API de SuiteCRM.
	 */
	public function save( LeadEntity $lead ): bool {
		$data = $lead->toArray();
		
		// Unificamos el motivo/mensaje para el CRM
		$reason = $data['message'] ?? 'Lead desde Formulario Web';
		if ( ! empty( $data['company'] ) ) {
			$reason .= " | Empresa: " . $data['company'];
		}

		$contact_info = ! empty( $lead->getPhone() ) ? $lead->getPhone() : $lead->getEmail();

		return $this->crm_service->createLead(
			$lead->getName(),
			$contact_info,
			$reason
		);
	}
}
