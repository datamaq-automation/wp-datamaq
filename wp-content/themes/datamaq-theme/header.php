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

<header id="dm-main-header" class="tw:fixed tw:top-0 tw:left-0 tw:right-0 tw:z-[10000] tw:h-[60.2px] tw:flex tw:items-center tw:bg-[#0c092f]/82 tw:backdrop-blur-2xl tw:border-b tw:border-white/10">
    <div class="tw:max-w-[1536px] tw:mx-auto tw:w-full tw:px-4 tw:flex tw:items-center tw:justify-between">
        
        <!-- Left: Logo & Isotype -->
        <a class="tw:flex tw:items-center tw:gap-3 tw:no-underline" href="<?php echo home_url('/'); ?>">
            <div class="c-logo-icon tw:bg-[#f97316] tw:text-[#0c092f] tw:w-[32px] tw:h-[32px] tw:flex tw:items-center tw:justify-center tw:rounded-lg tw:font-mono tw:font-black tw:text-lg">
                &gt;_
            </div>
            <span class="tw:text-white tw:text-xl tw:font-light tw:tracking-tight">DataMaq</span>
        </a>

        <!-- Right: Circular CTA -->
        <a href="http://legacy.localhost/contact" class="tw:w-[42px] tw:h-[42px] tw:rounded-full tw:bg-[#13142d] tw:border tw:border-white/10 tw:flex tw:items-center tw:justify-center tw:text-white hover:tw:bg-white/5 tw:transition-all tw:no-underline">
            <i class="bi bi-telephone-outbound tw:text-lg"></i>
        </a>

    </div>
</header>

<?php if ( is_front_page() ) : ?>
<div class="dm-app-shell" id="top" style="margin-top: 60.2px;">
<?php endif; ?>
