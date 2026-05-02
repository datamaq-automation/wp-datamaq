<?php
/**
 * DataMaq Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) exit;
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
function datamaq_inject_section($slug) {
    get_template_part('template-parts/content', $slug);
}

/**
 * Chatwoot Widget Integration
 */
add_action('wp_footer', function() {
    // 1. Verificar si está habilitado en los ajustes del plugin
    if (!get_option('datamaq_costs_chatwoot_enabled', true)) {
        echo '<!-- Chatwoot disabled via Datamaq Costs Settings -->';
        return;
    }

    // 2. Verificar si es entorno local
    if (strpos($_SERVER['HTTP_HOST'] ?? '', 'localhost') !== false) {
        echo '<!-- Chatwoot disabled in local development to prevent 429 errors -->';
        return;
    }
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
});

/**
 * DataMaq Repository Factory
 */
function dm_content_repo() {
    static $repo = null;
    if ($repo === null) {
        $repo = new \DataMaq\Infrastructure\Content\StaticContentRepository();
    }
    return $repo;
}

/**
 * Initialize SEO Service
 */
(new \DataMaq\Infrastructure\Seo\SeoService())->registerHooks();

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
add_filter( 'woocommerce_product_add_to_cart_text', function() {
    return 'Ver más';
});

// 2. Hacer que el botón redirija a la página del producto en lugar de añadir al carrito por AJAX
add_filter( 'woocommerce_loop_add_to_cart_link', function( $html, $product ) {
    return sprintf(
        '<div class="tw:text-center tw:mt-6 tw:mb-2">
            <a href="%s" class="tw:btn-primary c-ui-btn">%s</a>
        </div>',
        esc_url( $product->get_permalink() ),
        'Ver más'
    );
}, 10, 2 );

/**
 * Flujo de Compra Directa (DataMaq Audit)
 */
// 1. Redirigir directamente al Checkout al añadir al carrito
add_filter( 'woocommerce_add_to_cart_redirect', function() {
    return wc_get_checkout_url();
});

// 2. Cambiar texto del botón en la página de producto individual
add_filter( 'woocommerce_product_single_add_to_cart_text', function() {
    return 'Contratar ahora';
});
