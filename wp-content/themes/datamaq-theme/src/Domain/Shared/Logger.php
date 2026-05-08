<?php

namespace DataMaq\Domain\Shared;

/**
 * Interface Logger
 *
 * Define el contrato para la observabilidad del sistema.
 */
interface Logger {
	public function info( string $message, array $context = [] ): void;
	public function error( string $message, array $context = [] ): void;
	public function warning( string $message, array $context = [] ): void;
}
