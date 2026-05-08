<?php

namespace DataMaq\Application\Communication;

use DataMaq\Domain\Communication\ChatProvider;

/**
 * ChatManager (Application Service / Orchestrator)
 *
 * Gestiona la inicialización de múltiples canales de comunicación (WhatsApp, BotMan, etc.)
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
		foreach ( $providers as $provider ) {
			if ( $provider instanceof ChatProvider ) {
				$this->providers[] = $provider;
			}
		}
	}

	/**
	 * Inicializa todos los proveedores habilitados en el footer de WordPress.
	 */
	public function boot(): void {
		add_action(
			'wp_footer',
			function () {
				foreach ( $this->providers as $provider ) {
					if ( $provider->isEnabled() ) {
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
