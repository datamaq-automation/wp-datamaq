<?php
namespace DataMaq\Domain\Lead;

/**
 * Interface for Lead storage/delivery.
 */
interface LeadRepositoryInterface {
	/**
	 * Send the lead to ChatWoot
	 * @param LeadEntity $lead
	 * @return bool
	 */
	public function save( LeadEntity $lead ): bool;
}
