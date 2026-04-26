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
    $version = '3.0.1'; 
    $theme_uri = get_template_directory_uri();
    
    // Main Style (metadata)
    wp_enqueue_style( 'datamaq-style', get_stylesheet_uri(), array(), $version );
    
    // Bootstrap Icons
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3' );
    
    // Tailwind v4 Dist
    wp_enqueue_style( 'tailwind-styles', $theme_uri . '/assets/css/tailwind-dist.css', array(), $version );
    
    // Premium Aesthetics (migrated from child theme)
    wp_enqueue_style( 'premium-styles', $theme_uri . '/assets/css/premium.css', array('tailwind-styles'), $version );
    
    if ( class_exists( 'LearnPress' ) ) {
        wp_enqueue_style( 'learnpress-overrides', $theme_uri . '/assets/css/learnpress-overrides.css', array(), '1.4.1' );
    }

    // Register Contact Form Assets
    wp_register_style( 'dm-contact-form', $theme_uri . '/assets/css/contact-form.css', array(), $version );
    wp_register_script( 'dm-contact-wizard', $theme_uri . '/assets/js/contact-wizard.js', array(), $version, true );

    if ( is_front_page() || is_page_template('page-contact.php') ) {
        wp_enqueue_script( 'dm-contact-wizard' );
        wp_localize_script( 'dm-contact-wizard', 'datamaq_vars', array(
            'thanks_url' => home_url('/gracias')
        ) );
    }
}

/**
 * Global Scripts (Scroll, Offcanvas)
 */
add_action('wp_footer', 'dm_global_scripts', 999);
function dm_global_scripts() {
    ?>
    <script>
    (function() {
        const header = document.getElementById("dm-main-header");
        const scrollBtn = document.getElementById("scroll-to-top");
        const toggle = document.getElementById("mobile-menu-toggle");
        const close = document.getElementById("mobile-menu-close");
        const canvas = document.getElementById("mobile-offcanvas");
        const overlay = document.getElementById("offcanvas-overlay");

        const showMenu = function() {
            if (canvas) {
                canvas.classList.add("is-active");
                document.documentElement.classList.add("dmq-offcanvas-open");
                document.body.classList.add("dmq-offcanvas-open");
            }
        };

        const hideMenu = function() { 
            if (canvas) {
                canvas.classList.remove("is-active");
            }
            document.documentElement.classList.remove("dmq-offcanvas-open");
            document.body.classList.remove("dmq-offcanvas-open");
        };

        if (toggle) toggle.onclick = showMenu;
        if (close) close.onclick = hideMenu;
        if (overlay) overlay.onclick = hideMenu;
        
        document.querySelectorAll("#mobile-offcanvas a").forEach(a => {
            a.onclick = hideMenu;
        });

        // Optimized scroll listener
        let ticking = false;
        window.addEventListener("scroll", function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const scrollPos = window.scrollY;
                    if (header) {
                        header.classList.toggle("is-scrolled", scrollPos > 60);
                    }
                    if (scrollBtn) {
                        scrollBtn.classList.toggle("show", scrollPos > 400);
                    }
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        if (scrollBtn) {
            scrollBtn.onclick = function() { window.scrollTo({ top: 0, behavior: "smooth" }); };
        }
    })();
    </script>
    <style>
        /* Base Parity Rules */
        html { 
            scroll-behavior: smooth; 
            overflow-x: hidden;
            background-color: #0c092f;
        }
        body { 
            overflow-x: hidden; 
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }
        
        /* Offcanvas Styles */
        #mobile-offcanvas {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: none;
            justify-content: flex-end;
        }
        #mobile-offcanvas.is-active {
            display: flex;
        }
        #offcanvas-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .offcanvas-panel {
            position: relative;
            width: 100%;
            max-width: 320px;
            background: var(--dm-bg-0);
            height: 100%;
            box-shadow: -10px 0 30px rgba(0,0,0,0.5);
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
            display: flex;
            flex-direction: column;
            border-left: 1px solid rgba(255,255,255,0.08);
        }
        #mobile-offcanvas.is-active .offcanvas-panel {
            transform: translateX(0);
        }
        
        /* Body Lock */
        html.dmq-offcanvas-open,
        body.dmq-offcanvas-open {
            overflow: hidden !important;
            height: 100dvh !important;
        }

        /* Sticky Header Transition */
        #dm-main-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 80px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            background: transparent;
        }
        #dm-main-header.is-scrolled {
            height: 70px;
            background: rgba(12, 9, 47, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        /* Anchor Scroll Margin */
        [id] {
            scroll-margin-top: 100px;
        }

        /* Typography fixes */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 900;
            letter-spacing: -0.02em;
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

/**
 * Preload critical assets.
 */
add_action("wp_head", "dm_preload_assets", 1);
function dm_preload_assets() {
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
    </style>
    <?php
}
