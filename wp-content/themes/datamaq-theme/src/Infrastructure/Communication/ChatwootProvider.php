<?php

namespace DataMaq\Infrastructure\Communication;

use DataMaq\Domain\Communication\ChatProvider;
use DataMaq\Domain\Shared\ConfigProvider;

/**
 * ChatwootProvider
 *
 * Implementa la integración del widget de Chatwoot en el frontend.
 */
class ChatwootProvider implements ChatProvider {
	private ConfigProvider $config;
	private string $identifier = 'chatwoot';

	public function __construct( ConfigProvider $config ) {
		$this->config = $config;
	}

	public function getIdentifier(): string {
		return $this->identifier;
	}

	public function isEnabled(): bool {
		return ! empty( $this->config->get( 'CHATWOOT_WEBSITE_TOKEN' ) );
	}

	public function renderWidget(): void {
		$base_url = $this->config->get( 'CHATWOOT_BASE_URL', 'https://chatwoot.datamaq.com.ar' );
		$token    = $this->config->get( 'CHATWOOT_WEBSITE_TOKEN' );

		if ( ! $token ) {
			return;
		}

		?>
		<!-- Chatwoot Widget -->
		<script>
		  (function(d,t) {
			console.log('📡 [Chatwoot] Initializing SDK loader...');
			var BASE_URL="<?php echo esc_js( $base_url ); ?>";
			var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=BASE_URL+"/packs/js/sdk.js";
			g.async = true;
			s.parentNode.insertBefore(g,s);
			g.onload=function(){
			  console.log('✅ [Chatwoot] SDK Script loaded. Initializing widget...');
			  window.chatwootSDK.run({
				websiteToken: '<?php echo esc_js( $token ); ?>',
				baseUrl: BASE_URL
			  });
			  window.addEventListener('chatwoot:ready', function() {
				console.log('✨ [Chatwoot] Widget is READY and interactive.');
			  });
			}
			g.onerror=function() {
			  console.error('❌ [Chatwoot] Failed to load SDK script from ' + BASE_URL);
			}
		  })(document,"script");
		</script>
		<?php
	}
}
