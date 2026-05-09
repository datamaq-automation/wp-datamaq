<?php
namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadLogRepositoryInterface;
use DataMaq\Domain\Shared\Observability\TraceContext;

class WPLeadLogRepository implements LeadLogRepositoryInterface {
	private string $option_name = 'datamaq_leads_log';
	private int $max_logs = 50;

	public function log( LeadEntity $lead, bool $success ): void {
		$logs = $this->getLastLogs( $this->max_logs );
		
		$entry = array(
			'id'         => TraceContext::get(),
			'timestamp'  => current_time( 'mysql' ),
			'name'       => $lead->getName(),
			'email'      => $lead->getEmail(),
			'success'    => $success,
			'marketing'  => $lead->getMetadata(),
		);

		array_unshift( $logs, $entry );
		$logs = array_slice( $logs, 0, $this->max_logs );

		update_option( $this->option_name, $logs, false );
	}

	public function getLastLogs( int $limit = 20 ): array {
		$logs = get_option( $this->option_name, array() );
		if ( ! is_array( $logs ) ) {
			return array();
		}
		return array_slice( $logs, 0, $limit );
	}
}
