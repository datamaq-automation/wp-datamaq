<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <style>
        /* --- PARITY OVERRIDE: FIXED HEADER --- */
        header#dm-main-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 9999 !important;
            height: 64px !important;
            display: flex !important;
            align-items: center !important;
            transition: all 0.3s ease !important;
        }
        
        /* Layout Compensation */
        <?php if ( ! is_page_template( 'page-contact.php' ) ) : ?>
        body { padding-top: 64px !important; }
        <?php endif; ?>
        
        /* Mobile Reset */
        
        /* --- CACHE-PROOF FAB STYLES --- */
        .c-dm-fab {
            position: fixed !important;
            z-index: 10000 !important;
            width: 3.5rem !important;
            height: 3.5rem !important;
            border-radius: 9999px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4) !important;
            cursor: pointer !important;
            border: none !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
            text-decoration: none !important;
        }

        #whatsapp-fab {
            background-color: #25d366 !important;
            color: #ffffff !important;
            bottom: 1.5rem !important;
            right: 1.5rem !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        #whatsapp-fab:hover {
            transform: translateY(-5px) scale(1.1) !important;
            background-color: #ffffff !important;
            color: #25d366 !important;
        }

        #scroll-to-top {
            background-color: #ff9a4d !important;
            color: #0c092f !important;
            bottom: 1.5rem !important;
            left: 1.5rem !important;
            opacity: 0;
            visibility: hidden;
            transform: translateY(30px) !important;
        }

        #scroll-to-top.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }

        /* Mobile Optimization: Avoid the Dock */
        @media (max-width: 1024px) {
            #whatsapp-fab { bottom: 6.5rem !important; right: 1rem !important; }
            #scroll-to-top { bottom: 6.5rem !important; left: 1rem !important; }
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! is_page_template( 'page-contact.php' ) ) : ?>
<header id="dm-main-header" class="tw:bg-[#0c092f] tw:backdrop-blur-md tw:border-b tw:border-white/10" role="banner">
    <div class="tw:max-w-7xl tw:mx-auto tw:w-full tw:px-4 tw:flex tw:items-center tw:justify-between">
        <a class="tw:text-xl tw:font-bold tw:text-white" href="<?php echo home_url('/'); ?>" aria-label="DataMaq Home">DataMaq</a>
        
        <button
            id="mobile-menu-toggle"
            class="tw:lg:hidden tw:p-2 tw:text-white"
            type="button"
            aria-label="Abrir navegación"
        >
            <svg viewBox="0 0 24 24" width="24" height="24" class="tw:fill-current">
                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
            </svg>
        </button>

        <nav class="tw:hidden tw:lg:flex tw:ml-auto">
            <ul class="tw:flex tw:items-center tw:gap-8">
                <li><a class="tw:text-white/90 hover:tw:text-[#ff9a4d] tw:transition-colors" href="<?php echo home_url('#servicios'); ?>">Solución</a></li>
                <li><a class="tw:text-white/90 hover:tw:text-[#ff9a4d] tw:transition-colors" href="<?php echo home_url('#proceso'); ?>">Proceso</a></li>
                <li><a class="tw:text-white/90 hover:tw:text-[#ff9a4d] tw:transition-colors" href="<?php echo home_url('#faq'); ?>">FAQ</a></li>
                <li class="tw:ml-4">
                    <a class="tw:btn-primary" href="<?php echo home_url('#contacto'); ?>">Escribime</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<?php endif; ?>

<!-- Mobile Offcanvas -->
<div id="mobile-offcanvas" class="tw:fixed tw:inset-0 tw:z-[10000]">
    <div id="offcanvas-overlay" class="tw:fixed tw:inset-0 tw:bg-black/80 tw:backdrop-blur-md"></div>
    <div class="tw:fixed tw:right-0 tw:top-0 tw:bottom-0 tw:w-full tw:max-w-xs tw:bg-[#0c092f] tw:p-8 tw:shadow-2xl tw:flex tw:flex-col">
        <div class="tw:flex tw:items-center tw:justify-between tw:mb-12">
            <span class="tw:text-2xl tw:font-bold tw:text-white">DataMaq</span>
            <button id="mobile-menu-close" class="tw:p-2 tw:text-white">
                <svg viewBox="0 0 24 24" width="30" height="30" class="tw:fill-current"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            </button>
        </div>
        <nav>
            <ul class="tw:flex tw:flex-col tw:gap-8">
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#servicios">Solución</a></li>
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#proceso">Proceso</a></li>
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#faq">FAQ</a></li>
            </ul>
        </nav>
        <div class="tw:mt-auto">
            <a class="tw:btn-primary tw:w-full tw:py-4" href="#contacto">Escribime</a>
        </div>
    </div>
</div>
