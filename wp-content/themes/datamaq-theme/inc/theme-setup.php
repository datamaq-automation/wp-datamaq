<?php
/**
 * DataMaq Theme Setup
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Theme Support
 */
add_action( 'after_setup_theme', 'dm_theme_setup' );
function dm_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
}

/**
 * Enqueue styles and scripts.
 */
add_action( 'wp_enqueue_scripts', 'dm_enqueue_assets' );
function dm_enqueue_assets() {
    $version = '3.1.2';
    $theme_path = get_template_directory();
    $theme_uri = get_template_directory_uri();
    
    // Auto-versioning based on file modification time to bust cache
    $style_ver = file_exists($theme_path . '/style.css') ? filemtime($theme_path . '/style.css') : $version;
    $tailwind_ver = file_exists($theme_path . '/assets/css/tailwind-dist.css') ? filemtime($theme_path . '/assets/css/tailwind-dist.css') : $version;
    $index_ver = file_exists($theme_path . '/assets/css/index.css') ? filemtime($theme_path . '/assets/css/index.css') : $version;
    $premium_ver = file_exists($theme_path . '/assets/css/HomePage.css') ? filemtime($theme_path . '/assets/css/HomePage.css') : $version;
    $whatsapp_ver = file_exists($theme_path . '/assets/css/WhatsAppFab.css') ? filemtime($theme_path . '/assets/css/WhatsAppFab.css') : $version;
    $learnpress_ver = file_exists($theme_path . '/assets/css/learnpress-overrides.css') ? filemtime($theme_path . '/assets/css/learnpress-overrides.css') : '1.4.1';
    $wizard_ver = file_exists($theme_path . '/assets/js/contact-wizard.js') ? filemtime($theme_path . '/assets/js/contact-wizard.js') : $version;
    $comp_ver = file_exists($theme_path . '/assets/js/dm-components.js') ? filemtime($theme_path . '/assets/js/dm-components.js') : $version;

    // CSS
    wp_enqueue_style( 'datamaq-style', get_stylesheet_uri(), array(), $style_ver );
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3' );
    wp_enqueue_style( 'tailwind-styles', $theme_uri . '/assets/css/tailwind-dist.css', array(), $tailwind_ver );
    wp_enqueue_style( 'legacy-index-styles', $theme_uri . '/assets/css/index.css', array('tailwind-styles'), $index_ver );
    wp_enqueue_style( 'premium-styles', $theme_uri . '/assets/css/HomePage.css', array('legacy-index-styles'), $premium_ver );
    wp_enqueue_style( 'whatsapp-fab-styles', $theme_uri . '/assets/css/WhatsAppFab.css', array(), $whatsapp_ver );
    
    if ( class_exists( 'LearnPress' ) ) {
        wp_enqueue_style( 'learnpress-overrides', $theme_uri . '/assets/css/learnpress-overrides.css', array(), $learnpress_ver );
    }

    // JS Component Architecture
    wp_enqueue_script( 'dm-componentizer', $theme_uri . '/assets/js/dm-components.js', array(), $comp_ver, true );
    wp_enqueue_script( 'dm-comp-reveal', $theme_uri . '/assets/js/components/scroll-reveal.js', array('dm-componentizer'), $version, true );

    // Legacy Contact Wizard (to be refactored later into component)
    wp_register_script( 'dm-contact-wizard', $theme_uri . '/assets/js/contact-wizard.js', array('dm-componentizer'), $wizard_ver, true );

    if ( is_front_page() || is_page_template('page-contact.php') ) {
        wp_enqueue_script( 'dm-contact-wizard' );
        wp_localize_script( 'dm-contact-wizard', 'datamaq_vars', array(
            'thanks_url' => home_url('/gracias'),
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('datamaq_contact_nonce')
        ) );
    }
}

/**
 * Global Head Styles
 */
add_action("wp_head", "dm_critical_styles", 1);
function dm_critical_styles() {
    $theme_uri = get_template_directory_uri();
    ?>
    <link rel="preload" href="<?php echo $theme_uri; ?>/assets/fonts/inter-var.woff2" as="font" type="font/woff2" crossorigin>
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('<?php echo $theme_uri; ?>/assets/fonts/inter-var.woff2') format('woff2');
            font-weight: 100 900;
            font-display: swap;
            font-style: normal;
        }
        /* 
         * Design Tokens (SOLID & DDD Architecture)
         */
        :root {
            --dm-color-brand-primary: #ff6a00;
            --dm-color-bg-main: #0c092f;
            --dm-color-bg-surface: #050314;
            --dm-color-text-primary: #ffffff;
            --dm-color-text-muted: rgba(255, 255, 255, 0.7);
            
            /* Dynamic Surface Tokens */
            --dm-current-text: var(--dm-color-text-primary);
            --dm-current-bg: var(--dm-color-bg-main);
        }

        .is-light-context {
            --dm-current-text: #050314;
            --dm-current-bg: #ffffff;
        }

        .is-dark-context {
            --dm-current-text: var(--dm-color-text-primary);
            --dm-current-bg: var(--dm-color-bg-main);
        }

        /* Base Parity Rules */
        html { 
            scroll-behavior: smooth; 
            overflow-x: hidden;
            background-color: var(--dm-color-bg-main);
            color: var(--dm-color-text-primary);
        }
        body { 
            overflow-x: hidden; 
            margin: 0;
            -webkit-font-smoothing: antialiased;
            background-color: var(--dm-current-bg);
            color: var(--dm-current-text);
        }
        [id] { scroll-margin-top: 100px; }
        h1, h2, h3, h4, h5, h6 { font-weight: 900; letter-spacing: -0.02em; color: inherit; }
        
        /* Reveal Animations */
        [data-dm-component="ScrollReveal"] {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        [data-dm-component="ScrollReveal"].is-revealed {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <?php
}

/**
 * Register Shortcodes
 */
add_action('init', 'dm_register_shortcodes');
function dm_register_shortcodes() {
    add_shortcode('datamaq_whatsapp', function() {
        $data = get_datamaq_site_data();
        return esc_url($data['brand']['whatsapp']);
    });
    add_shortcode('datamaq_email', function() {
        $data = get_datamaq_site_data();
        return esc_html($data['brand']['email']);
    });
    add_shortcode('datamaq_contact_form', function() {
        ob_start();
        get_template_part('template-parts/content', 'contact');
        return ob_get_clean();
    });
}
