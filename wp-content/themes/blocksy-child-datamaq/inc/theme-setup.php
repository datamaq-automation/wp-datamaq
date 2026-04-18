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
    $version = '2.2.0'; // Increment for cache busting
    
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style'), $version );
    
    // Tailwind v4 Dist
    wp_enqueue_style( 'tailwind-styles', get_stylesheet_directory_uri() . '/assets/css/tailwind-dist.css', array(), $version );
    
    if ( class_exists( 'LearnPress' ) ) {
        wp_enqueue_style( 'learnpress-overrides', get_stylesheet_directory_uri() . '/assets/css/learnpress-overrides.css', array(), '1.4.1' );
    }
}

/**
 * Navigation & Scroll Toggle JS
 */
add_action('wp_footer', 'dm_child_global_scripts', 999);
function dm_child_global_scripts() {
    ?>
    <script>
    (function() {
        const header = document.querySelector('header.tw\\:fixed');
        const scrollBtn = document.getElementById('scroll-to-top');
        const toggle = document.getElementById('mobile-menu-toggle');
        const close = document.getElementById('mobile-menu-close');
        const canvas = document.getElementById('mobile-offcanvas');
        const overlay = document.getElementById('offcanvas-overlay');

        if (!canvas) return;

        toggle.onclick = function() { 
            canvas.style.display = 'block'; 
            canvas.classList.add('is-active');
            document.body.classList.add('menu-open');
        };

        const hide = function() { 
            canvas.style.display = 'none'; 
            canvas.classList.remove('is-active');
            document.body.classList.remove('menu-open');
        };

        if (close) close.onclick = hide;
        if (overlay) overlay.onclick = hide;
        document.querySelectorAll('#mobile-offcanvas a').forEach(a => a.onclick = hide);

        window.addEventListener('scroll', function() {
            const scrollPos = window.scrollY;
            if (header) {
                if (scrollPos > 60) header.classList.add('is-scrolled');
                else header.classList.remove('is-scrolled');
            }
            if (scrollBtn) {
                if (scrollPos > 400) scrollBtn.classList.add('show');
                else scrollBtn.classList.remove('show');
            }
        });

        if (scrollBtn) {
            scrollBtn.onclick = function() { window.scrollTo({ top: 0, behavior: 'smooth' }); };
        }
    })();
    </script>
    <?php
}
