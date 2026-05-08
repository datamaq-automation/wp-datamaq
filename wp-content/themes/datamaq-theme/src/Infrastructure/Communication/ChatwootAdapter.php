<?php

namespace DataMaq\Infrastructure\Communication;

use DataMaq\Domain\Communication\ChatProvider;

/**
 * Adapter para la integración con Chatwoot.
 */
class ChatwootAdapter implements ChatProvider {

	public function getIdentifier(): string {
		return 'chatwoot';
	}

	public function isEnabled(): bool {
		// 1. Verificar si está habilitado en los ajustes (hardcoded por ahora como estaba en functions.php)
		if ( ! get_option( 'datamaq_costs_chatwoot_enabled', true ) ) {
			return false;
		}

		// 2. Deshabilitar en entorno local para evitar errores 429
		if ( strpos( $_SERVER['HTTP_HOST'] ?? '', 'localhost' ) !== false ) {
			return false;
		}

		return true;
	}

	public function renderWidget(): void {
		?>
		<script>
			(function(d,t) {
			var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src="https://chatwoot.datamaq.com.ar/packs/js/sdk.js";
			g.defer = true;
			g.async = true;
			g.onload=function(){
				window.chatwootSDK.run({
				websiteToken: 'x42oXgvquc13HvqzB28SigaP',
				baseUrl: 'https://chatwoot.datamaq.com.ar'
				})
			  
				window.addEventListener('chatwoot:ready', function () {
				window.$chatwoot.setCustomAttributes({
					wp_theme: 'datamaq-theme'
				});
				// Bridge para la abstracción de DataMaq
				document.dispatchEvent(new CustomEvent('datamaq:chat:ready'));
				});
			}
			s.parentNode.insertBefore(g,s);
			})(document,"script");
		</script>
		<style>
			.woot-widget-bubble {
			right: 20px !important;
			bottom: 20px !important;
			}
			@media (max-width: 1024px) {
			.woot-widget-bubble {
				bottom: 6.5rem !important;
				right: 1rem !important;
			}
			}
		</style>
		<?php
	}
}
