<?php

namespace DataMaq\Infrastructure\Shared;

use DataMaq\Domain\Shared\ConfigProvider;

/**
 * Adapter WPConfigProvider
 *
 * Implementa el acceso a la configuración usando las opciones de WordPress.
 */
class WPConfigProvider implements ConfigProvider {
	public function get( string $key, $default = null ) {
		// 1. Prioridad: Constantes de PHP (definidas en wp-config.php)
		if ( defined( $key ) ) {
			return constant( $key );
		}

		// 2. Variables de Entorno (si están cargadas)
		$env_val = getenv( $key );
		if ( false !== $env_val ) {
			return $env_val;
		}

		if ( isset( $_ENV[ $key ] ) ) {
			return $_ENV[ $key ];
		}

		// 3. Opciones de WordPress (Base de Datos)
		return get_option( $key, $default );
	}


	public function isEnabled( string $feature ): bool {
		$option_name = "datamaq_{$feature}_enabled";
		return (bool) $this->get( $option_name, true );
	}
}
