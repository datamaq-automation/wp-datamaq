<?php

namespace DataMaq\Infrastructure\Communication;

use DataMaq\Domain\Communication\ChatProvider;
use DataMaq\Domain\Shared\ConfigProvider;

/**
 * Adapter para el acceso directo a WhatsApp.
 * Representa el canal de comunicación tradicional de la marca.
 */
class WhatsAppAdapter implements ChatProvider {

	private ConfigProvider $config;
	private string $whatsapp_url;

	/**
	 * @param ConfigProvider $config Proveedor de configuración.
	 * @param string         $whatsapp_url URL directa de WhatsApp (desde el repositorio de contenido).
	 */
	public function __construct( ConfigProvider $config, string $whatsapp_url ) {
		$this->config       = $config;
		$this->whatsapp_url = $whatsapp_url;
	}

	public function getIdentifier(): string {
		return 'whatsapp';
	}

	public function isEnabled(): bool {
		// Por ahora siempre habilitado, o según una opción de config.
		return $this->config->isEnabled( 'whatsapp', true );
	}

	public function renderWidget(): void {
		// Por ahora el renderizado sigue en el footer.php estático para no romper el diseño actual.
		// En el futuro, podríamos mover el HTML del FAB (Floating Action Button) aquí.
		echo '<!-- WhatsApp Channel Active -->';
	}

	public function getUrl(): string {
		return $this->whatsapp_url;
	}
}
