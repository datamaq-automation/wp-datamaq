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
    <style>
        /* V6 DESIGN SYSTEM: TOKENS & ATMOSPHERE */
        :root {
            --dm-accent-orange-rgb: 255, 106, 0;
            --dm-data-cyan-rgb: 34, 211, 238;
            --dm-line-blueprint-rgb: 226, 233, 243;
            --dm-app-bg: #03041a;
            --dm-shell-bg: #0c092f;
        }

        body {
            background-color: var(--dm-app-bg) !important;
            background-image: 
                radial-gradient(circle at 10% 10%, rgba(var(--dm-data-cyan-rgb), 0.2) 0%, transparent 45%),
                radial-gradient(circle at 90% 90%, rgba(var(--dm-accent-orange-rgb), 0.15) 0%, transparent 45%) !important;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* THE APP SHELL (CENTERED CARD) - V6 PARITY */
        <?php if ( is_front_page() ) : ?>
        .dm-app-shell {
            max-width: 1440px;
            margin: 2.5rem auto;
            background-color: var(--dm-shell-bg);
            border-radius: 2rem;
            box-shadow: 0 50px 150px rgba(0,0,0,0.9);
            position: relative;
            z-index: 10;
            overflow: visible; /* Changed from hidden to fix sticky header */
            border: 1px solid rgba(255,255,255,0.08);
            animation: shellEntry 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        /* We use a pseudo-element to clip the top background since we removed overflow:hidden */
        .dm-app-shell::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 100px;
            background: linear-gradient(to bottom, rgba(12, 9, 47, 0.4), transparent);
            border-radius: 2rem 2rem 0 0;
            pointer-events: none;
            z-index: 1;
        }
        @keyframes shellEntry {
            from { opacity: 0; transform: translateY(30px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @media (max-width: 1480px) {
            .dm-app-shell { margin: 1.5rem; border-radius: 1.5rem; }
        }
        @media (max-width: 768px) {
            .dm-app-shell { margin: 0; border-radius: 0; box-shadow: none; border: none; overflow: visible; }
        }
        <?php endif; ?>

        /* Typography Precision */
        .c-home-hero__title, .c-home-section-title, h1, h2, h3 {
            letter-spacing: -0.03em !important;
            line-height: 0.98 !important;
            font-weight: 800 !important;
        }
        .c-home-eyebrow, .dm-eyebrow {
            letter-spacing: 0.14em !important;
            font-weight: 900 !important;
            text-transform: uppercase;
            font-size: 0.72rem;
            color: #ff6a00;
        }
        
        /* Sticky Header FIX */
        #dm-main-header {
            position: -webkit-sticky !important;
            position: sticky !important;
            top: 0;
            z-index: 10000;
            background: rgba(12, 9, 47, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            height: 72px;
            display: flex;
            align-items: center;
        }
        /* Mobile adjustment */
        @media (max-width: 768px) {
            #dm-main-header { height: 64px; }
        }

        .dm-btn-cta {
            background-color: #ff6a00 !important;
            border-color: #ff6a00 !important;
            color: #0c092f !important;
            font-weight: 800 !important;
            border-radius: 12px !important;
            padding: 0.75rem 2.25rem !important;
            box-shadow: 0 4px 14px 0 rgba(255, 106, 0, 0.3);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dm-btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 106, 0, 0.4);
            background-color: #ff8533 !important;
        }

        .c-logo-icon {
            background-color: #f97316;
            color: #0c092f;
            border-radius: 8px;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-weight: 900;
            font-size: 24px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
    </style>
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
