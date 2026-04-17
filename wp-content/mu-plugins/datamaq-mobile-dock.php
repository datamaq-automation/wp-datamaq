<?php
/**
 * Plugin Name: DataMaq Mobile Dock (Phase 2)
 * Version: 1.3
 * Description: Implements a native-like floating navigation dock matching Vue.js architecture.
 */

add_action('wp_enqueue_scripts', function() {
    // Ensure Bootstrap Icons are available
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css', [], null);
});

add_action('wp_footer', function() {
    ?>
    <!-- DataMaq Mobile Dock -->
    <nav class="c-home-dock" aria-label="Navegación rápida" style="--dock-columns: 2;">
        <div class="c-home-dock__container">
            <a href="#hero" class="c-home-dock__item">
                <i class="bi bi-house-door"></i>
                <span>Inicio</span>
            </a>
            <a href="#perfil" class="c-home-dock__item">
                <i class="bi bi-person-badge"></i>
                <span>Perfil</span>
            </a>
            <a href="#servicios" class="c-home-dock__item">
                <i class="bi bi-gear-wide-connected"></i>
                <span>Servicios</span>
            </a>
            <a href="#contacto" class="c-home-dock__item">
                <i class="bi bi-chat-dots"></i>
                <span>Contacto</span>
            </a>
        </div>
    </nav>

    <style>
        .c-home-dock {
            position: fixed !important;
            bottom: 12px !important;
            left: 13.6px !important;
            right: 13.6px !important;
            height: 87.59375px !important;
            z-index: 1045 !important;
            background: rgba(15, 27, 58, 0.9) !important;
            backdrop-filter: blur(18px) !important;
            -webkit-backdrop-filter: blur(18px) !important;
            border: 1px solid var(--mobile-card-border, rgba(226, 233, 243, 0.18)) !important;
            border-radius: 24px !important;
            box-shadow: var(--dm-shadow, 0 10px 30px rgba(0,0,0,0.3));
            display: grid !important;
            grid-template-columns: repeat(var(--dock-columns, 2), 1fr);
            gap: 8px;
            padding: 12px;
        }

        @media (min-width: 1024px) {
            .c-home-dock {
                display: none !important;
            }
        }

        .c-home-dock__container {
            display: contents; /* Rely on parent grid */
        }

        .c-home-dock__item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            color: var(--mobile-card-text, rgba(226, 233, 243, 0.82)) !important;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.2s ease;
            gap: 4px;
            background: var(--mobile-card-surface, rgba(12, 9, 47, 0.92));
            border-radius: 14px;
        }

        .c-home-dock__item i {
            font-size: 20px;
            line-height: 1;
        }

        .c-home-dock__item:active {
            transform: scale(0.95);
            background: var(--dm-accent-orange, #ff9a4d);
            color: var(--dm-bg-0, #0c092f) !important;
        }
    </style>
    <?php
}, 100);
