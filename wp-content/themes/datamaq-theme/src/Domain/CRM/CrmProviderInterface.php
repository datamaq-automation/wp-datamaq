<?php

namespace DataMaq\Domain\CRM;

/**
 * Interfaz para el proveedor de CRM.
 * Define el contrato que cualquier implementación (SuiteCRM, HubSpot, etc.) debe cumplir.
 */
interface CrmProviderInterface {

	/**
	 * Envía un nuevo Lead al CRM.
	 *
	 * @param string $name Nombre del contacto.
	 * @param string $contact_info Teléfono o Email proporcionado.
	 * @param string $reason El motivo o máquina que necesita.
	 * @return bool True si se insertó correctamente, False si falló.
	 */
	public function createLead( string $name, string $contact_info, string $reason ): bool;

}
