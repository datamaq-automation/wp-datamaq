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
		wp_enqueue_script( 'datamaq-chat-bridge', get_template_directory_uri() . '/assets/js/chat-bridge.js', array(), '1.0.0', true );
	}
);

$config_provider = new \DataMaq\Infrastructure\Shared\WPConfigProvider();
$logger          = new \DataMaq\Infrastructure\Shared\WPLogger();

// Inicialización de BotMan (Motor + UI)
$botman_adapter = new \DataMaq\Infrastructure\Communication\BotmanAdapter( $config_provider, $logger );
$chat_manager   = new \DataMaq\Application\Communication\ChatManager( $botman_adapter );
$chat_manager->boot();

// Registro de API REST para el Chat
add_action( 'rest_api_init', function() use ( $botman_adapter ) {
	( new \DataMaq\Infrastructure\WordPress\ChatRestController( $botman_adapter ) )->register_routes();
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
