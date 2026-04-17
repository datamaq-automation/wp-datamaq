<?php
/**
 * Plugin Name: DataMaq Mobile Dock (Phase 2)
 * Version: 1.0
 * Description: Implements a native-like floating navigation dock for mobile devices.
 */

add_action('wp_enqueue_scripts', function() {
    // Ensure Bootstrap Icons are available
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css', [], null);
});

add_action('wp_footer', function() {
    ?>
    <!-- DataMaq Mobile Dock -->
    <nav class="c-mobile-dock">
        <div class="c-mobile-dock__container">
            <a href="/" class="c-mobile-dock__item <?php echo is_front_page() ? 'is-active' : ''; ?>">
                <i class="bi bi-house-door"></i>
                <span>Inicio</span>
            </a>
            <a href="/course/" class="c-mobile-dock__item <?php echo (is_post_type_archive('lp_course') || is_tax('course_category')) ? 'is-active' : ''; ?>">
                <i class="bi bi-book"></i>
                <span>Cursos</span>
            </a>
            <a href="https://wa.me/datamaq" class="c-mobile-dock__item">
                <i class="bi bi-whatsapp"></i>
                <span>WhatsApp</span>
            </a>
            <a href="/perfil/" class="c-mobile-dock__item <?php echo is_page('lp-profile') ? 'is-active' : ''; ?>">
                <i class="bi bi-person-circle"></i>
                <span>Perfil</span>
            </a>
        </div>
    </nav>

    <style>
        .c-mobile-dock {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 48px);
            max-width: 420px;
            height: 72px;
            background: var(--dm-bg-dark, rgba(12, 9, 47, 0.82));
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--dm-border-0, rgba(226, 233, 243, 0.12));
            border-radius: 20px;
            z-index: 9999;
            display: none; /* Hidden by default, shown on mobile */
            box-shadow: var(--dm-shadow, 0 10px 30px rgba(0,0,0,0.3));
        }

        @media (max-width: 1024px) {
            .c-mobile-dock {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        .c-mobile-dock__container {
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: space-around;
            align-items: center;
            padding: 0 12px;
        }

        .c-mobile-dock__item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            color: var(--dm-text-muted, #99a9d1) !important;
            font-size: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
            flex: 1;
            gap: 4px;
        }

        .c-mobile-dock__item i {
            font-size: 22px;
            line-height: 1;
        }

        .c-mobile-dock__item.is-active {
            color: var(--dm-accent-orange, #ff9a4d) !important;
        }

        .c-mobile-dock__item:active {
            transform: scale(0.92);
        }

        /* Adjust footer space if needed - Already handled by SRS 2.3 118px padding */
    </style>
    <?php
});
