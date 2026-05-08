<?php

namespace DataMaq\Domain\Shared\Observability;

/**
 * Servicio de Dominio para Observabilidad.
 * Define la interfaz de lo que queremos observar en el sistema.
 */
interface LoggerInterface {
	public function info( string $message, array $context = array() ): void;
	public function error( string $message, array $context = array() ): void;
	public function warning( string $message, array $context = array() ): void;
}
