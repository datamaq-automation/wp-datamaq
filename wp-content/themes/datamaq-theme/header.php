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
    <a class="skip-link" href="#contenido-principal">Saltar al contenido principal</a>

<header id="dm-main-header" class="c-home-header" role="banner">
    <div class="tw:container tw:mx-auto tw:px-4 c-home-header__inner">
        <?php
        try {
            $viewModel = new \DataMaq\UI\ViewModels\HeaderViewModel(dm_content_repo());
        } catch (\Throwable $e) {
            error_log('DataMaq Error: Failed to initialize HeaderViewModel - ' . $e->getMessage());
            if (defined('WP_DEBUG') && WP_DEBUG) {
                echo "<!-- Error in HeaderViewModel: " . esc_html($e->getMessage()) . " -->";
            }
            $viewModel = null;
        }
        ?>
        
        <!-- Isotipo y Logo -->
        <a href="<?php echo $viewModel ? esc_url($viewModel->getHomeUrl()) : '/'; ?>" class="tw:flex tw:items-center tw:gap-2 tw:text-dm-text-0 tw:decoration-0" aria-label="DataMaq, inicio">
            <span class="c-home-header__brand-icon" aria-hidden="true">
                <i class="bi bi-terminal-fill"></i>
            </span>
            <span class="c-home-header__brand-copy"><?php echo $viewModel ? esc_html($viewModel->getSiteName()) : 'DataMaq'; ?></span>
        </a>

        <!-- Navegación Primaria (Adaptada para WP) -->
        <nav class="c-home-header__nav tw:hidden tw:lg:flex" aria-label="Navegación principal">
            <?php if ($viewModel) : ?>
                <?php foreach ($viewModel->getNavigation() as $nav) : ?>
                    <a href="<?php echo esc_url(home_url($nav['href'])); ?>" class="c-home-header__nav-link"><?php echo esc_html($nav['label']); ?></a>
                <?php endforeach; ?>
            <?php else : ?>
                <a href="#servicios" class="c-home-header__nav-link">Solución</a>
                <a href="#faq" class="c-home-header__nav-link">FAQ</a>
            <?php endif; ?>
        </nav>

        <!-- CTAs de Acción (Modular) -->
        <?php get_template_part('template-parts/header-actions', null, ['viewModel' => $viewModel]); ?>

    </div>
</header>


