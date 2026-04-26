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
