<?php

namespace DataMaq\Infrastructure\Communication;

use DataMaq\Domain\Communication\ChatProvider;
use DataMaq\Domain\Shared\ConfigProvider;
use DataMaq\Domain\Shared\Logger;

/**
 * Adapter para la integración con BotMan.
 */
class BotmanAdapter implements ChatProvider {

	private ConfigProvider $config;
	private Logger $logger;

	public function __construct( ConfigProvider $config, Logger $logger ) {
		$this->config = $config;
		$this->logger = $logger;
	}

	public function getIdentifier(): string {
		return 'botman';
	}

	public function isEnabled(): bool {
		return $this->config->isEnabled( 'botman' );
	}

	public function renderWidget(): void {
		$this->logger->info( 'Rendering Botman widget.' );
		// TODO: Implementar el script del widget de BotMan (Tidio, Botman Web Widget, etc.)
		?>
		<!-- Botman Widget Placeholder -->
		<script>
			console.log('DataMaq: Botman loading...');
		</script>
		<?php
	}
}
