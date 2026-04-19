<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! is_page_template( 'page-contact.php' ) ) : ?>
<header id="dm-main-header" class="tw:bg-[#0c092f] tw:backdrop-blur-md tw:border-b tw:border-white/10" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 9999; height: 60px; display: flex; align-items: center; backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);" role="banner">
    <div class="tw:max-w-7xl tw:mx-auto tw:w-full tw:px-4 tw:flex tw:items-center tw:justify-between">
        <a class="tw:text-xl tw:font-bold tw:text-white" href="<?php echo home_url('/'); ?>" aria-label="DataMaq Home">DataMaq</a>
        
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
                <li><a class="tw:text-white/90 hover:tw:text-[#ff9a4d] tw:transition-colors" href="<?php echo home_url('#servicios'); ?>">Soluci&oacute;n</a></li>
                <li><a class="tw:text-white/90 hover:tw:text-[#ff9a4d] tw:transition-colors" href="<?php echo home_url('#faq'); ?>">FAQ</a></li>
                <li class="tw:ml-4">
                    <a class="tw:btn-primary" href="<?php echo home_url('#contacto'); ?>">Contacto</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div class="header-spacer" style="height: 60px;"></div>
<?php endif; ?>

<!-- Mobile Offcanvas -->
<div id="mobile-offcanvas" class="tw:hidden tw:fixed tw:inset-0 tw:z-[10000]">
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
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#servicios">Soluci&oacute;n</a></li>
                <li><a class="tw:text-xl tw:font-bold tw:text-white" href="#faq">FAQ</a></li>
            </ul>
        </nav>
        <div class="tw:mt-auto">
            <a class="tw:btn-primary tw:w-full tw:py-4" href="#contacto">Escribime</a>
        </div>
    </div>
</div>
