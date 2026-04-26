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
<div id="top" class="app-shell app-shell--home tw:min-h-screen app-shell--variant-direct">

<header id="dm-main-header" class="c-home-header" role="banner">
    <div class="tw:container tw:mx-auto tw:px-4 c-home-header__inner">
        
        <!-- Isotipo y Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tw:flex tw:items-center tw:gap-2 tw:text-dm-text-0 tw:decoration-0" aria-label="DataMaq, inicio">
            <span class="c-home-header__brand-icon" aria-hidden="true">
                <i class="bi bi-terminal-fill"></i>
            </span>
            <span class="c-home-header__brand-copy">DataMaq</span>
        </a>

        <!-- Navegación Primaria (Adaptada para WP) -->
        <nav class="c-home-header__nav tw:hidden tw:lg:flex" aria-label="Navegación principal">
            <a href="<?php echo esc_url( home_url( '#servicios' ) ); ?>" class="c-home-header__nav-link">Solución</a>
            <a href="<?php echo esc_url( home_url( '#faq' ) ); ?>" class="c-home-header__nav-link">FAQ</a>
        </nav>

        <!-- CTAs de Contacto -->
        <div class="c-home-header__actions">
            <!-- Icono Mobile -->
            <a href="http://legacy.localhost/contact" class="c-home-header__icon-link tw:lg:hidden" aria-label="Contacto" title="Contacto">
                <i class="bi bi-telephone-forward-fill" aria-hidden="true"></i>
            </a>
            <!-- Botón Desktop -->
            <a href="http://legacy.localhost/contact" class="tw:btn-primary c-home-header__cta tw:hidden tw:lg:inline-flex tw:no-underline">Contacto</a>
        </div>

    </div>
</header>


