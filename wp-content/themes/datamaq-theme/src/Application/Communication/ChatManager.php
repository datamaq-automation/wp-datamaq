<?php

namespace DataMaq\Application\Communication;

use DataMaq\Domain\Communication\ChatProvider;

/**
 * ChatManager (Application Service / Orchestrator)
 *
 * Gestiona la inicialización del sistema de chat activo.
 */
class ChatManager {
	private ?ChatProvider $provider = null;

	public function __construct( ChatProvider $provider ) {
		$this->provider = $provider;
	}

	/**
	 * Inicializa el chat en el footer de WordPress si está habilitado.
	 */
	public function boot(): void {
		add_action(
			'wp_footer',
			function () {
				if ( $this->provider && $this->provider->isEnabled() ) {
					$this->provider->renderWidget();
				} else {
					echo '<!-- Chat disabled by ' . esc_html( $this->provider ? $this->provider->getIdentifier() : 'No Provider' ) . ' logic -->';
				}
			}
		);
	}

	/**
	 * Devuelve el proveedor activo.
	 */
	public function getProvider(): ?ChatProvider {
		return $this->provider;
	}
}
