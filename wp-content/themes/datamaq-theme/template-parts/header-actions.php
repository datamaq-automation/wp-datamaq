<?php
/**
 * Template part for displaying header actions (CTAs).
 * 
 * @var array $args
 */

// Extraemos el ViewModel del array de argumentos (Arquitectura Limpia)
$viewModel = $args['viewModel'] ?? null;

if (!$viewModel) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo '<!-- DEBUG: HeaderViewModel missing in header-actions.php -->';
    }
    return;
}

$contact_url = $viewModel->getContactUrl();
$training_url = $viewModel->getTrainingUrl();
$relevamiento_url = $viewModel->getRelevamientoUrl();
$automatizacion_url = $viewModel->getAutomatizacionUrl();
?>

<div class="c-home-header__actions tw:flex tw:items-center tw:gap-3">
    <!-- Relevamiento -->
    <!-- Icono Mobile -->
    <a href="<?php echo esc_url($relevamiento_url); ?>" class="c-home-header__icon-link tw:lg:hidden" aria-label="Relevamiento" title="Relevamiento">
        <i class="bi bi-geo-alt" aria-hidden="true"></i>
    </a>
    <!-- Botón Desktop -->
    <button onclick="window.location.href='<?php echo esc_url($relevamiento_url); ?>'" type="button" class="tw:btn-outline c-home-header__cta tw:hidden tw:lg:inline-flex">Relevamiento</button>

    <!-- Automatización -->
    <!-- Icono Mobile -->
    <a href="<?php echo esc_url($automatizacion_url); ?>" class="c-home-header__icon-link tw:lg:hidden" aria-label="Automatización" title="Automatización">
        <i class="bi bi-gear-wide-connected" aria-hidden="true"></i>
    </a>
    <!-- Botón Desktop -->
    <button onclick="window.location.href='<?php echo esc_url($automatizacion_url); ?>'" type="button" class="tw:btn-outline c-home-header__cta tw:hidden tw:lg:inline-flex">Automatización</button>

    <!-- Capacitaciones -->
    <!-- Icono Mobile -->
    <a href="<?php echo esc_url($training_url); ?>" class="c-home-header__icon-link tw:lg:hidden" aria-label="Cursos" title="Cursos">
        <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
    </a>
    <!-- Botón Desktop -->
    <button onclick="window.location.href='<?php echo esc_url($training_url); ?>'" type="button" class="tw:btn-outline c-home-header__cta tw:hidden tw:lg:inline-flex">Cursos</button>

    <!-- Contacto -->
    <!-- Icono Mobile -->
    <a href="<?php echo esc_url($contact_url); ?>" class="c-home-header__icon-link tw:lg:hidden" aria-label="Contacto" title="Contacto">
        <i class="bi bi-telephone-forward-fill" aria-hidden="true"></i>
    </a>
    <!-- Botón Desktop -->
    <button onclick="window.location.href='<?php echo esc_url($contact_url); ?>'" type="button" class="tw:btn-primary c-home-header__cta tw:hidden tw:lg:inline-flex">Contacto</button>
</div>
