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
		return get_option( $key, $default );
	}

	public function isEnabled( string $feature ): bool {
		$option_name = "datamaq_{$feature}_enabled";
		return (bool) $this->get( $option_name, true );
	}
}
