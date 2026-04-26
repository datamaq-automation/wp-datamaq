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

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="dm-main-header" class="c-home-header tw:fixed tw:top-0 tw:left-0 tw:right-0 tw:z-[10000] tw:h-[60.2px] tw:flex tw:items-center tw:bg-[#0c092f]/82 tw:backdrop-blur-2xl tw:border-b tw:border-white/10" role="banner">
    <div class="tw:container tw:mx-auto tw:px-4 c-home-header__inner tw:w-full tw:flex tw:items-center tw:justify-between">
        
        <a href="<?php echo home_url('/'); ?>" class="tw:flex tw:items-center tw:gap-2 tw:text-white tw:no-underline" aria-label="DataMaq, inicio">
            <span class="c-home-header__brand-icon tw:w-[40px] tw:h-[40px] tw:rounded-full tw:bg-[#ff9a4d]/14 tw:flex tw:items-center tw:justify-center" aria-hidden="true">
                <i class="bi bi-terminal-fill tw:text-[#ff6a00] tw:text-[18.4px]"></i>
            </span>
            <span class="c-home-header__brand-copy tw:text-xl tw:font-light tw:tracking-tight">DataMaq</span>
        </a>

        <div class="c-home-header__actions">
            <a href="http://legacy.localhost/contact" class="c-home-header__icon-link tw:w-[42px] tw:h-[42px] tw:rounded-full tw:bg-[#13142d] tw:border tw:border-white/10 tw:flex tw:items-center tw:justify-center tw:text-white hover:tw:bg-white/5 tw:transition-all tw:no-underline" aria-label="Contacto" title="Contacto">
                <i class="bi bi-telephone-forward-fill tw:text-lg" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</header>

<?php if ( is_front_page() ) : ?>
<div class="dm-app-shell" id="top" style="margin-top: 60.2px;">
<?php endif; ?>
