<?php

namespace DataMaq\Domain\Shared\Health;

/**
 * Interface para verificar la salud de los servicios externos.
 */
interface HealthRepositoryInterface {
	/**
	 * Verifica si un servicio específico está respondiendo.
	 * 
	 * @param string $service_key Identificador del servicio (ej: 'orchestrator').
	 * @return array{status: string, message: string, latency: float}
	 */
	public function checkStatus( string $service_key ): array;
}
