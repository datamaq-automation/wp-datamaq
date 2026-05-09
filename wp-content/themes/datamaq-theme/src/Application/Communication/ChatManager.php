<?php

namespace DataMaq\Application\Communication;

use DataMaq\Domain\Communication\ChatProvider;

/**
 * ChatManager (Application Service / Orchestrator)
 *
 * Gestiona la inicialización de múltiples canales de comunicación (WhatsApp, Chatwoot, etc.)
 */
class ChatManager {
	/**
	 * @var ChatProvider[]
	 */
	private array $providers = array();

	/**
	 * @param ChatProvider[] $providers Lista de proveedores a gestionar.
	 */
	public function __construct( array $providers ) {
		$this->providers = $providers;
	}

	/**
	 * Inicializa todos los proveedores habilitados en el footer de WordPress.
	 */
	public function boot(): void {
		add_action(
			'wp_footer',
			function () {
				error_log( '[DataMaq-Chat] Booting Manager. Providers: ' . count( $this->providers ) );
				foreach ( $this->providers as $provider ) {
					$enabled = $provider->isEnabled();
					error_log( sprintf( '[DataMaq-Chat] Provider %s is %s', $provider->getIdentifier(), $enabled ? 'ENABLED' : 'DISABLED' ) );
					if ( $enabled ) {
						$provider->renderWidget();
					}
				}
			}
		);
	}

	/**
	 * Devuelve un proveedor específico por su identificador.
	 */
	public function getProvider( string $identifier ): ?ChatProvider {
		foreach ( $this->providers as $provider ) {
			if ( $provider->getIdentifier() === $identifier ) {
				return $provider;
			}
		}
		return null;
	}
}
