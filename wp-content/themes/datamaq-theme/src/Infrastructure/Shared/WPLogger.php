<?php

namespace DataMaq\Infrastructure\Shared;

use DataMaq\Domain\Shared\Observability\LoggerInterface;

/**
 * Implementación de Logger usando el error_log de WordPress.
 */
class WPLogger implements LoggerInterface {

	public function info( string $message, array $context = array() ): void {
		$this->log( 'INFO', $message, $context );
	}

	public function error( string $message, array $context = array() ): void {
		$this->log( 'ERROR', $message, $context );
	}

	public function warning( string $message, array $context = array() ): void {
		$this->log( 'WARNING', $message, $context );
	}

	private function log( string $level, string $message, array $context ): void {
		$formatted_context = ! empty( $context ) ? ' | Context: ' . wp_json_encode( $context ) : '';
		error_log( sprintf( '[DataMaq-%s] %s%s', $level, $message, $formatted_context ) );
	}
}
