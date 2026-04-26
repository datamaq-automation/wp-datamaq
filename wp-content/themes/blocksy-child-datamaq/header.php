<?php
/**
 * Template part for displaying the header with V6 Absolute Parity + App Shell.
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
<header id="dm-contact-header" style="background: rgba(12, 9, 47, 0.88); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.08); height: 72px; display: flex; align-items: center; width: 100%; z-index: 10000;">
    <div class="tw:max-w-7xl tw:mx-auto tw:w-full tw:px-6 tw:flex tw:items-center tw:justify-between">
        <a class="tw:text-xl tw:font-bold tw:text-white tw:flex tw:items-center tw:gap-3" href="<?php echo home_url('/'); ?>">
            <span class="c-logo-icon">&gt;_</span>
            <span class="tw:tracking-tight">DataMaq</span>
        </a>
        <a class="tw:btn tw:border tw:border-white/20 tw:text-white tw:px-6 tw:py-2 tw:rounded-xl" href="<?php echo home_url('/'); ?>">Inicio</a>
    </div>
</header>

<?php elseif ( is_page_template( 'page-gracias.php' ) ) : ?>
<header id="dm-thanks-header" style="height: 80px; display: flex; align-items: center; width: 100%; z-index: 10000; position: absolute; top: 0;">
    <div class="tw:container tw:mx-auto tw:px-6 tw:flex tw:items-center tw:justify-between">
        <h2 class="tw:text-white/40 tw:text-sm tw:font-black tw:uppercase tw:tracking-widest">Estado del env&iacute;o</h2>
        <a href="<?php echo home_url('/'); ?>" class="tw:text-white/60 hover:tw:text-white tw:text-3xl tw:transition-all"><i class="bi bi-x-lg"></i></a>
    </div>
</header>

<?php else : ?>
<header id="dm-main-header">
    <div class="tw:max-w-7xl tw:mx-auto tw:w-full tw:px-6 tw:flex tw:items-center tw:justify-between">
        <a class="tw:text-xl tw:font-bold tw:text-white tw:flex tw:items-center tw:gap-3" href="<?php echo home_url('/'); ?>">
            <span class="c-logo-icon">&gt;_</span>
            <span class="tw:tracking-tight">DataMaq</span>
        </a>
        
        <button id="mobile-menu-toggle" class="tw:p-2 tw:text-white tw:lg:hidden" aria-label="Abrir men&uacute;"><svg viewBox="0 0 24 24" width="28" height="28" class="tw:fill-current"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg></button>

        <nav class="tw:hidden tw:lg:flex tw:ml-auto">
            <ul class="tw:flex tw:items-center tw:gap-10">
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#servicios'); ?>">Soluci&oacute;n</a></li>
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#proceso'); ?>">Proceso</a></li>
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#perfil'); ?>">Perfil</a></li>
                <li><a class="tw:text-white/70 hover:tw:text-[#ff6a00] tw:transition-colors tw:text-sm tw:font-bold tw:no-underline" href="<?php echo home_url('#faq'); ?>">FAQ</a></li>
                <li class="tw:ml-4"><a class="tw:btn dm-btn-cta tw:no-underline" href="<?php echo home_url('#contacto'); ?>">Escribime</a></li>
            </ul>
        </nav>
    </div>
</header>
<?php endif; ?>
