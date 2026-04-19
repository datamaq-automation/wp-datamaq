<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <style>
        /* Logo Icon Specific Styles to ensure Parity without relying on Tailwind compile */
        .c-logo-icon {
            background-color: #f97316;
            color: #0c092f;
            border-radius: 4px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-weight: 700;
            font-size: 20px;
        }
        /* Nav link typography adjustments */
        .dm-nav-link {
            font-size: 15.68px;
            font-weight: 400;
            color: rgba(226, 233, 243, 0.88) !important;
            transition: color 0.2s ease;
        }
        .dm-nav-link:hover {
            color: #ff6a00 !important;
        }
        /* CTA Typography and Shape */
        .dm-btn-cta {
            background-color: #ff6a00 !important;
            border-color: #ff6a00 !important;
            color: #0c092f !important;
            font-weight: 500 !important;
            border-radius: 12px !important;
            font-size: 16px !important;
            padding: 0.5rem 1.25rem;
            transition: all 0.2s ease;
        }
        .dm-btn-cta:hover {
            background-color: #ff8533 !important;
            border-color: #ff8533 !important;
            transform: translateY(-1px);
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! is_page_template( 'page-contact.php' ) ) : ?>
<header id="dm-main-header" class="tw:fixed tw:bg-[#0c092f]/80 tw:backdrop-blur-md tw:border-b tw:border-white/10" style="top: 0; left: 0; width: 100%; z-index: 9999; height: 64px; display: flex; align-items: center; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);" role="banner">
    <div class="tw:max-w-7xl tw:mx-auto tw:w-full tw:px-4 tw:flex tw:items-center tw:justify-between">
        <a class="tw:text-xl tw:font-bold tw:text-white tw:flex tw:items-center tw:gap-2" href="<?php echo home_url('/'); ?>" aria-label="DataMaq Home">
            <span class="c-logo-icon">&gt;_</span>
            <span>DataMaq</span>
        </a>
        
        <button
            id="mobile-menu-toggle"
            class="tw:lg:hidden tw:p-2 tw:text-white"
            type="button"
            aria-label="Abrir navegaci&oacute;n"
        >
            <svg viewBox="0 0 24 24" width="24" height="24" class="tw:fill-current">
                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
            </svg>
        </button>

        <nav class="tw:hidden tw:lg:flex tw:ml-auto">
            <ul class="tw:flex tw:items-center tw:gap-8">
                <li><a class="dm-nav-link" href="<?php echo home_url('#servicios'); ?>">Soluci&oacute;n</a></li>
                <li><a class="dm-nav-link" href="<?php echo home_url('#proceso'); ?>">Proceso</a></li>
                <li><a class="dm-nav-link" href="<?php echo home_url('#tarifas'); ?>">Alcance</a></li>
                <li><a class="dm-nav-link" href="<?php echo home_url('#cobertura'); ?>">Cobertura</a></li>
                <li><a class="dm-nav-link" href="<?php echo home_url('#faq'); ?>">FAQ</a></li>
                <li class="tw:ml-4">
                    <a class="tw:btn dm-btn-cta" href="<?php echo home_url('#contacto'); ?>">Escribime</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div class="header-spacer" style="height: 64px;"></div>
<?php endif; ?>

<!-- Mobile Offcanvas -->
<div id="mobile-offcanvas" class="tw:fixed tw:inset-0 tw:z-[10000]" style="display: none;">
    <div id="offcanvas-overlay" class="tw:fixed tw:inset-0 tw:bg-black/80 tw:backdrop-blur-md"></div>
    <div class="tw:fixed tw:right-0 tw:top-0 tw:bottom-0 tw:w-full tw:max-w-xs tw:bg-[#0c092f] tw:p-8 tw:shadow-2xl tw:flex tw:flex-col">
        <div class="tw:flex tw:items-center tw:justify-between tw:mb-12">
            <div class="tw:flex tw:items-center tw:gap-2">
                <span class="c-logo-icon">&gt;_</span>
                <span class="tw:text-2xl tw:font-bold tw:text-white">DataMaq</span>
            </div>
            <button id="mobile-menu-close" class="tw:p-2 tw:text-white">
                <svg viewBox="0 0 24 24" width="30" height="30" class="tw:fill-current"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            </button>
        </div>
        <nav>
            <ul class="tw:flex tw:flex-col tw:gap-8">
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#servicios">Soluci&oacute;n</a></li>
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#proceso">Proceso</a></li>
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#tarifas">Alcance</a></li>
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#cobertura">Cobertura</a></li>
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#faq">FAQ</a></li>
            </ul>
        </nav>
        <div class="tw:mt-auto">
            <a class="tw:btn dm-btn-cta tw:w-full tw:py-4" style="text-align: center;" href="#contacto">Escribime</a>
        </div>
    </div>
</div>

