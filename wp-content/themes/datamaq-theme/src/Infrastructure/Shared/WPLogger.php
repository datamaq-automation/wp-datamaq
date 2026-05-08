<?php

namespace DataMaq\Infrastructure\Shared;

use DataMaq\Domain\Shared\Logger;

/**
 * Adapter WPLogger
 *
 * Implementa el logging usando error_log de PHP/WordPress.
 */
class WPLogger implements Logger {
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
		$formatted_context = ! empty( $context ) ? ' | Context: ' . json_encode( $context ) : '';
		error_log( sprintf( '[DataMaq-%s] %s%s', $level, $message, $formatted_context ) );
	}
}
