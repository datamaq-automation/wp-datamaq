<?php
/**
 * DataMaq Theme Setup
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue parent and child styles.
 */
add_action( 'wp_enqueue_scripts', 'dm_child_enqueue_styles', 999 );
function dm_child_enqueue_styles() {
    $version = '2.2.5'; // Increment for cache busting
    
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style'), $version );
    
    // Google Fonts localization enabled
    
    // Bootstrap Icons
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3' );
    
    // Tailwind v4 Dist
    wp_enqueue_style( 'tailwind-styles', get_stylesheet_directory_uri() . '/assets/css/tailwind-dist.css', array(), $version );
    
    if ( class_exists( 'LearnPress' ) ) {
        wp_enqueue_style( 'learnpress-overrides', get_stylesheet_directory_uri() . '/assets/css/learnpress-overrides.css', array(), '1.4.1' );
    }

    // Register Contact Form Assets (Enqueued via shortcode or template)
    wp_register_style( 'dm-contact-form', get_stylesheet_directory_uri() . '/assets/css/contact-form.css', array(), $version );
    wp_register_script( 'dm-contact-form', get_stylesheet_directory_uri() . '/assets/js/contact-form.js', array(), $version, true );
}

/**
 * Navigation & Scroll Toggle JS - Optimized with requestAnimationFrame
 */
add_action('wp_footer', 'dm_child_global_scripts', 999);
function dm_child_global_scripts() {
    ?>
    <script>
    (function() {
        const header = document.getElementById("dm-main-header") || document.querySelector('header.tw\\:fixed');
        const scrollBtn = document.getElementById("scroll-to-top");
        const toggle = document.getElementById("mobile-menu-toggle");
        const close = document.getElementById("mobile-menu-close");
        const canvas = document.getElementById("mobile-offcanvas");
        const overlay = document.getElementById("offcanvas-overlay");

        if (toggle && canvas) {
            toggle.onclick = function() { 
                canvas.style.display = "block"; 
                canvas.classList.add("is-active");
                document.body.classList.add("menu-open");
            };
        }

        const hide = function() { 
            if (canvas) {
                canvas.style.display = "none"; 
                canvas.classList.remove("is-active");
            }
            document.body.classList.remove("menu-open");
        };

        if (close) close.onclick = hide;
        if (overlay) overlay.onclick = hide;
        document.querySelectorAll("#mobile-offcanvas a").forEach(a => a.onclick = hide);

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
    <?php
}

/**
 * Register DataMaq Shortcodes
 */
add_action('init', 'dm_register_shortcodes');
function dm_register_shortcodes() {
    add_shortcode('datamaq_whatsapp', function() {
        if (!function_exists("get_datamaq_site_data")) return "#";
        $data = get_datamaq_site_data();
        return esc_url($data['brand']['whatsapp']);
    });

    add_shortcode('datamaq_email', function() {
        if (!function_exists("get_datamaq_site_data")) return "info@datamaq.com.ar";
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
add_action("wp_head", "dm_child_preload_assets", 1);
function dm_child_preload_assets() {
    $theme_uri = get_stylesheet_directory_uri();
    ?>
    <link rel="preload" href="<?php echo $theme_uri; ?>/assets/fonts/inter-var.woff2" as="font" type="font/woff2" crossorigin>
    <?php
}
