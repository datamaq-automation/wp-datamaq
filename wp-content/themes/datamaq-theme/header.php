<?php
/**
 * Main Header Template - Minimalist 1:1 Parity
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

<body <?php body_class('has-consent-banner'); ?>>
<?php wp_body_open(); ?>
<div id="app" data-v-app="">
<div data-v-236fef00="" id="top" class="app-shell app-shell--home tw:min-h-screen app-shell--variant-direct">

<header id="dm-main-header" class="c-home-header" role="banner">
    <div class="tw:container tw:mx-auto tw:px-4 c-home-header__inner">
        
        <a aria-current="page" href="<?php echo home_url('/'); ?>" class="tw:flex tw:items-center tw:gap-2 tw:text-dm-text-0 tw:decoration-0" aria-label="DataMaq, inicio">
            <span class="c-home-header__brand-icon" aria-hidden="true">
                <i class="bi bi-terminal-fill"></i>
            </span>
            <span class="c-home-header__brand-copy">DataMaq</span>
        </a>

        <nav class="c-home-header__nav tw:hidden tw:lg:flex" aria-label="Navegación principal">
            <a aria-current="page" href="<?php echo home_url('#servicios'); ?>" class="c-home-header__nav-link">Solución</a>
            <a aria-current="page" href="<?php echo home_url('#faq'); ?>" class="c-home-header__nav-link">FAQ</a>
        </nav>

        <div class="c-home-header__actions">
            <a href="http://legacy.localhost/contact" class="c-home-header__icon-link tw:lg:hidden" aria-label="Contacto" title="Contacto">
                <i class="bi bi-telephone-forward-fill" aria-hidden="true"></i>
            </a>
            <a href="http://legacy.localhost/contact" class="tw:btn-primary c-home-header__cta tw:hidden tw:lg:inline-flex tw:no-underline">Contacto</a>
        </div>

    </div>
</header>


