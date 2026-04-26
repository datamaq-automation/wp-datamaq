<?php
/**
 * Main Header Template
 */
?>
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

<?php if ( is_front_page() ) : ?>
<div class="dm-app-shell" id="top">
<?php endif; ?>

<?php if ( is_page_template( 'page-contact.php' ) ) : ?>
<header id="dm-contact-header" class="tw:fixed tw:top-0 tw:left-0 tw:right-0 tw:z-[10000] tw:h-[72px] tw:flex tw:items-center tw:bg-[#0c092f]/88 tw:backdrop-blur-2xl tw:border-b tw:border-white/5">
    <div class="tw:max-w-7xl tw:mx-auto tw:w-full tw:px-6 tw:flex tw:items-center tw:justify-between">
        <a class="tw:text-xl tw:font-bold tw:text-white tw:flex tw:items-center tw:gap-3 tw:no-underline" href="<?php echo home_url('/'); ?>">
            <span class="c-logo-icon">&gt;_</span>
            <span class="tw:tracking-tight">DataMaq</span>
        </a>
        <a class="tw:btn tw:border tw:border-white/20 tw:text-white tw:px-6 tw:py-2 tw:rounded-xl tw:no-underline hover:tw:bg-white/5 tw:transition-all" href="<?php echo home_url('/'); ?>">Inicio</a>
    </div>
</header>

<?php elseif ( is_page_template( 'page-gracias.php' ) ) : ?>
<header id="dm-thanks-header" class="tw:fixed tw:top-0 tw:left-0 tw:right-0 tw:z-[10000] tw:h-[80px] tw:flex tw:items-center">
    <div class="tw:container tw:mx-auto tw:px-6 tw:flex tw:items-center tw:justify-between">
        <h2 class="tw:text-white/40 tw:text-sm tw:font-black tw:uppercase tw:tracking-widest">Estado del env&iacute;o</h2>
        <a href="<?php echo home_url('/'); ?>" class="tw:text-white/60 hover:tw:text-white tw:text-3xl tw:transition-all"><i class="bi bi-x-lg"></i></a>
    </div>
</header>

<?php else : ?>
<header id="dm-main-header" data-dm-component="Header">
    <div class="tw:max-w-7xl tw:mx-auto tw:w-full tw:px-6 tw:flex tw:items-center tw:justify-between">
        <a class="tw:text-xl tw:font-bold tw:text-white tw:flex tw:items-center tw:gap-3 tw:no-underline" href="<?php echo home_url('/'); ?>">
            <span class="c-logo-icon">&gt;_</span>
            <span class="tw:tracking-tight">DataMaq</span>
        </a>
        
        <button id="mobile-menu-toggle" class="tw:p-2 tw:text-white tw:lg:hidden tw:bg-transparent tw:border-none tw:cursor-pointer" aria-label="Abrir men&uacute;">
            <svg viewBox="0 0 24 24" width="28" height="28" class="tw:fill-current"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
        </button>

        <nav class="tw:hidden tw:lg:flex tw:ml-auto">
            <ul class="tw:flex tw:items-center tw:gap-10 tw:list-none tw:m-0 tw:p-0">
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#servicios'); ?>">Soluci&oacute;n</a></li>
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#proceso'); ?>">Proceso</a></li>
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#perfil'); ?>">Perfil</a></li>
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#faq'); ?>">FAQ</a></li>
                <li class="tw:ml-4"><a class="tw:btn dm-btn-cta tw:no-underline" href="<?php echo home_url('#contacto'); ?>">Escribime</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Mobile Offcanvas -->
<div id="mobile-offcanvas" data-dm-component="MobileMenu">
    <div id="offcanvas-overlay"></div>
    <div class="offcanvas-panel">
        <div class="tw:flex tw:items-center tw:justify-between tw:p-6 tw:border-b tw:border-white/5">
            <span class="tw:text-white tw:font-bold tw:text-lg">Men&uacute;</span>
            <button id="mobile-menu-close" class="tw:text-white/40 hover:tw:text-white tw:bg-transparent tw:border-none tw:cursor-pointer">
                <i class="bi bi-x-lg tw:text-2xl"></i>
            </button>
        </div>
        <nav class="tw:p-6">
            <ul class="tw:flex tw:flex-col tw:gap-6 tw:list-none tw:m-0 tw:p-0">
                <li><a class="tw:text-2xl tw:font-black tw:text-white tw:no-underline hover:tw:text-orange-500" href="<?php echo home_url('#top'); ?>">Inicio</a></li>
                <li><a class="tw:text-2xl tw:font-black tw:text-white tw:no-underline hover:tw:text-orange-500" href="<?php echo home_url('#servicios'); ?>">Soluci&oacute;n</a></li>
                <li><a class="tw:text-2xl tw:font-black tw:text-white tw:no-underline hover:tw:text-orange-500" href="<?php echo home_url('#proceso'); ?>">Proceso</a></li>
                <li><a class="tw:text-2xl tw:font-black tw:text-white tw:no-underline hover:tw:text-orange-500" href="<?php echo home_url('#perfil'); ?>">Perfil</a></li>
                <li><a class="tw:text-2xl tw:font-black tw:text-white tw:no-underline hover:tw:text-orange-500" href="<?php echo home_url('#faq'); ?>">FAQ</a></li>
                <li class="tw:mt-4">
                    <a class="tw:btn tw:bg-orange-500 tw:text-[#0c092f] tw:font-black tw:py-4 tw:px-8 tw:rounded-xl tw:block tw:text-center tw:no-underline" href="<?php echo home_url('#contacto'); ?>">
                        Consultar ahora
                    </a>
                </li>
            </ul>
        </nav>
        <div class="tw:mt-auto tw:p-6 tw:border-t tw:border-white/5">
            <p class="tw:text-white/40 tw:text-xs tw:uppercase tw:tracking-widest tw:mb-4">Contacto directo</p>
            <a href="mailto:info@datamaq.com.ar" class="tw:text-white tw:font-bold tw:block tw:mb-2">info@datamaq.com.ar</a>
            <a href="https://wa.me/5491156297160" class="tw:text-green-500 tw:font-bold tw:flex tw:items-center tw:gap-2">
                <i class="bi bi-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
