<?php
/**
 * Plugin Name: DataMaq Design System Vue Migration
 * Version: 1.7
 * Description: Full 32+ variable design system, sticky header fix, cross-selector compatibility, and dock styling.
 */
add_action('wp_enqueue_scripts', function() {
    // Enqueue Inter Font
    wp_enqueue_style('dm-font-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap', [], null);
    // Enqueue Bootstrap Icons (already enqueued by dock plugin, but good for completeness)
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css', [], null);

    // Try multiple handles for inline style injection
    $handles = ['ct-main-styles', 'blocksy-dynamic-global', 'blocksy-style', 'learnpress'];

    $css = '
        :root {
            /* Full set of 29 variables from Audit VM439 / Staging Bridge */
            --dm-bg-0: #0c092f;
            --dm-bg-1: #0b2766;
            --dm-bg-2: #155697;
            --dm-text-0: #e2e9f3;
            --dm-text-muted: #99a9d1;
            --dm-accent-orange: #ff9a4d;
            --dm-data-cyan: #ff6a00;
            --dm-data-cyan-rgb: 255, 106, 0;
            --dm-accent-orange-rgb: 255, 154, 77;
            --dm-surface-0: rgba(15, 27, 58, 0.78);
            --dm-border-0: rgba(226, 233, 243, 0.12);
            --dm-radius-lg: 28px;
            --dm-shadow: 0 1.4rem 3rem rgba(12, 9, 47, 0.35);
            --ui-font-family-base: "Inter", system-ui, -apple-system, sans-serif;

            /* Extended tokens found in staging/Vue bridge */
            --dm-accent: #ff6a00;
            --dm-accent-2: #ff9a4d;
            --dm-ink: #0f1b3a;
            --dm-muted: #55627a;
            --dm-line: #e5e8f0;
            --dm-surface: #ffffff;
            --dm-surface-soft: #f7f9fc;
            --dm-surface-1: rgba(30, 41, 67, 0.85); /* New */
            --dm-border-1: rgba(226, 233, 243, 0.25); /* New */
            --dm-whatsapp-green: #25d366; /* New */
            --dm-line-blueprint: rgba(var(--dm-accent-orange-rgb), 0.2); /* New */
            --dm-radius-1: 14px; /* New */
            --dm-overlay-vignette: radial-gradient(circle, transparent 40%, rgba(12, 9, 47, 0.4) 100%); /* New */

            /* SRS compat variables */
            --dm-bg-dark: rgba(12, 9, 47, 0.82);
            --dm-bg-solid: var(--dm-bg-0);
            --dm-bg-footer: rgba(12, 9, 47, 0.92);
            --dm-text: var(--dm-text-0);
            --dm-section-pad: 52px;
            --dm-section-margin: 28px;
        }

        body {
            background: #0c092f !important;
            color: var(--dm-text-0) !important;
            font-family: var(--ui-font-family-base) !important;
        }

        /*
           Header: Fixed -> Sticky per SRS Spec
           Using multiple selectors to ensure victory over theme JS/CSS
        */
        .ct-header, .site-header, header.wp-block-template-part {
            background: var(--dm-bg-dark) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            position: sticky !important;
            position: -webkit-sticky !important;
            top: 0 !important;
            z-index: 1040 !important;
            display: block !important; /* Ensure it stays in flow */
        }

        .ct-header *, .site-header * { color: var(--dm-text) !important; }

        /* Footer Fixes */
        .ct-footer, .site-footer {
            background: var(--dm-bg-footer) !important;
            color: var(--dm-text) !important;
            padding: 32px 0 118px 0 !important;
        }

        /* Section Aliases */
        .c-home-hero, .c-home-profile, .c-home-services, .c-home-faq, .c-contact {
            padding: var(--dm-section-pad) 0 !important;
            margin-top: var(--dm-section-margin) !important;
            background: var(--dm-surface-0) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            border: 1px solid var(--dm-border-0) !important;
            border-radius: var(--dm-radius-lg) !important;
            box-shadow: var(--dm-shadow) !important;
            color: var(--dm-text) !important;
        }
        .c-home-hero { margin-top: 0 !important; }
        .c-contact { background: var(--dm-bg-solid) !important; padding: 40px 0 !important; }
    ';

    $injected = false;
    foreach ($handles as $handle) {
        if (wp_style_is($handle, 'registered')) {
            wp_add_inline_style($handle, $css);
            $injected = true;
        }
    }

    // Always inject in head as well to be absolutely sure
    add_action('wp_head', function() use ($css) {
        echo '<style id="dm-design-system-core">' . $css . '</style>';
    }, 999);
}, 20);
