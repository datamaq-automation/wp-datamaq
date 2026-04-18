<?php
/**
 * Blocksy Child Datamaq functions and definitions
 * SOLID Refactoring - Modular Architecture
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Data Layer
require_once get_stylesheet_directory() . '/inc/site-data.php';

// 2. Business Logic & AJAX
require_once get_stylesheet_directory() . '/inc/ajax-handlers.php';

// 3. Theme Setup & Assets
require_once get_stylesheet_directory() . '/inc/theme-setup.php';

/**
 * Injection Controller (Legacy wrapper for backward compatibility if needed)
 * Note: New sections should be loaded via get_template_part() in templates.
 */
function blocksy_child_inject_section($slug) {
    get_template_part('template-parts/content', $slug);
}

/**
 * Chatwoot Widget Integration
 */
add_action('wp_footer', function() {
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
          wp_theme: 'blocksy-child-datamaq'
        });
      });
    }
    s.parentNode.insertBefore(g,s);
  })(document,"script");
</script>
<style>
  /* Ensure Chatwoot bubble is visible and correctly positioned */
  .woot-widget-bubble {
    right: 20px !important;
    bottom: 20px !important;
  }
  @media (max-width: 1024px) {
    .woot-widget-bubble {
      bottom: 6.5rem !important; /* Matches previous WhatsApp mobile position */
      right: 1rem !important;
    }
  }
</style>
<?php
});
