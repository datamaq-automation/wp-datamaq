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
		// 1. Prioridad: Opciones de WordPress (Base de Datos / Panel Admin)
		// Intentamos con prefijo datamaq_ y sin él
		$wp_option = get_option( 'datamaq_' . strtolower( $key ) );
		if ( false !== $wp_option && '' !== $wp_option ) {
			return $wp_option;
		}

		$wp_option_direct = get_option( $key );
		if ( false !== $wp_option_direct && '' !== $wp_option_direct ) {
			return $wp_option_direct;
		}

		// 2. Variables de Entorno
		$env_val = getenv( $key );
		if ( false !== $env_val && '' !== $env_val ) {
			return $env_val;
		}

		if ( isset( $_ENV[ $key ] ) ) {
			return $_ENV[ $key ];
		}

		// 3. Constantes de PHP (wp-config.php)
		if ( defined( $key ) ) {
			return constant( $key );
		}

		return $default;
	}


	public function isEnabled( string $feature ): bool {
		$option_name = "datamaq_{$feature}_enabled";
		return (bool) $this->get( $option_name, true );
	}
}
