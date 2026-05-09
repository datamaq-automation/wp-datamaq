<?php
/**
 * DataMaq Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require get_template_directory() . '/inc/autoloader.php';

// 1. Data Layer
require_once get_template_directory() . '/inc/site-data.php';

// 2. Business Logic & AJAX
require_once get_template_directory() . '/inc/ajax-handlers.php';

// 3. Theme Setup & Assets
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/admin-settings.php';

/**
 * Injection Controller
 */
function datamaq_inject_section( $slug ) {
	get_template_part( 'template-parts/content', $slug );
}

/**
 * Communication System Initialization (Hexagonal Architecture)
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		// Cargamos en el header (false) para interceptar peticiones tempranas
		wp_enqueue_script( 'datamaq-chat', get_template_directory_uri() . '/assets/js/datamaq-chat.js', array(), '1.0.2', false );
	},
	1
);

// Configuración de Comunicación (Hexagonal Architecture)
$config_provider = new \DataMaq\Infrastructure\Shared\WPConfigProvider();
$logger          = new \DataMaq\Infrastructure\Shared\WPLogger();
$content_repo    = dm_content_repo();

// 1. Observabilidad y Salud
$health_repo     = new \DataMaq\Infrastructure\Shared\ExternalHealthAdapter( $logger );
$obs_controller  = new \DataMaq\Infrastructure\WordPress\ObservabilityController( $logger, $health_repo );

add_action( 'rest_api_init', function() use ( $obs_controller ) {
	$obs_controller->register_routes();
} );

/**
 * DataMaq Chat Manager Factory/Helper
 */
function dm_chat_manager() {
	static $manager = null;
	if ( null === $manager ) {
		$config_provider = new \DataMaq\Infrastructure\Shared\WPConfigProvider();
		$logger          = new \DataMaq\Infrastructure\Shared\WPLogger();
		$content_repo    = dm_content_repo();

		// 1. WhatsApp
		$whatsapp_url = $content_repo->getFooterSection()->getWhatsappUrl();
		$whatsapp_provider = new \DataMaq\Infrastructure\Communication\WhatsAppAdapter( $config_provider, $whatsapp_url );

		// 2. BotMan
		$chatbot_service = new \DataMaq\Domain\Chat\ChatbotService();
		$botman_provider = new \DataMaq\Infrastructure\Communication\BotmanAdapter( $config_provider, $logger, $chatbot_service );

		$manager = new \DataMaq\Application\Communication\ChatManager( array( $whatsapp_provider, $botman_provider ) );
	}
	return $manager;
}

// Inicialización
dm_chat_manager()->boot();

// Registro de API REST para el Chat (BotMan)
add_action( 'rest_api_init', function() {
	$botman = dm_chat_manager()->getProvider( 'botman' );
	if ( $botman ) {
		( new \DataMaq\Infrastructure\WordPress\ChatRestController( $botman ) )->register_routes();
	}
} );

/**
 * DataMaq Repository Factory
 */
function dm_content_repo() {
	static $repo = null;
	if ( null === $repo ) {
		$repo = new \DataMaq\Infrastructure\Content\StaticContentRepository();
	}
	return $repo;
}

/**
 * Lead Submission Use Case Factory
 */
function dm_submit_lead_use_case() {
	static $use_case = null;
	if ( null === $use_case ) {
		$logger = new \DataMaq\Infrastructure\Shared\WPLogger();
		
		// 1. SuiteCRM Repository
		$crm_service = new \DataMaq\Infrastructure\CRM\SuiteCrmService(
			defined('SUITECRM_BASE_URL') ? SUITECRM_BASE_URL : '',
			defined('SUITECRM_CLIENT_ID') ? SUITECRM_CLIENT_ID : '',
			defined('SUITECRM_CLIENT_SECRET') ? SUITECRM_CLIENT_SECRET : '',
			defined('SUITECRM_USERNAME') ? SUITECRM_USERNAME : '',
			defined('SUITECRM_PASSWORD') ? SUITECRM_PASSWORD : '',
			$logger
		);
		$crm_repo = new \DataMaq\Infrastructure\Lead\SuiteCrmLeadRepository( $crm_service );

		// 2. n8n Repository (Existing)
		$n8n_repo = new \DataMaq\Infrastructure\Lead\N8nLeadRepository();

		// Composite: Send to both
		$composite_repo = new \DataMaq\Infrastructure\Lead\CompositeLeadRepository( array( $crm_repo, $n8n_repo ) );

		$use_case = new \DataMaq\Application\Lead\SubmitLeadUseCase( $composite_repo );
	}
	return $use_case;
}

/**
 * Initialize SEO Service
 */
( new \DataMaq\Infrastructure\Seo\SeoService() )->registerHooks();

/**
 * WooCommerce Clean Up
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/**
 * Personalización de botones de WooCommerce
 */
// 1. Cambiar texto del botón en el catálogo
add_filter(
	'woocommerce_product_add_to_cart_text',
	function () {
		return 'Ver más';
	}
);

// 2. Hacer que el botón redirija a la página del producto en lugar de añadir al carrito por AJAX
add_filter(
	'woocommerce_loop_add_to_cart_link',
	function ( $html, $product ) {
		return sprintf(
			'<div class="tw:text-center tw:mt-6 tw:mb-2">
            <a href="%s" class="tw:btn-primary c-ui-btn">%s</a>
        </div>',
			esc_url( $product->get_permalink() ),
			'Ver más'
		);
	},
	10,
	2
);

/**
 * Flujo de Compra Directa (DataMaq Audit)
 */
// 1. Redirigir directamente al Checkout al añadir al carrito
add_filter(
	'woocommerce_add_to_cart_redirect',
	function () {
		return wc_get_checkout_url();
	}
);

// 2. Cambiar texto del botón en la página de producto individual
add_filter(
	'woocommerce_product_single_add_to_cart_text',
	function () {
		return 'Contratar ahora';
	}
);
