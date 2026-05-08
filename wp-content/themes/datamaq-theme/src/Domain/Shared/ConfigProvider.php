<?php

namespace DataMaq\Domain\Shared;

/**
 * Interface ConfigProvider
 *
 * Abstrae el acceso a la configuración (WordPress options, ENV, etc.)
 */
interface ConfigProvider {
	/**
	 * Obtiene un valor de configuración.
	 */
	public function get( string $key, $default = null );

	/**
	 * Verifica si una característica está habilitada.
	 */
	public function isEnabled( string $feature ): bool;
}
