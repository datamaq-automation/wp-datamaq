<?php
/**
 * Template part for displaying the hero section.
 * Refactored to use ViewModel Pattern.
 */
$viewModel = new \DataMaq\UI\ViewModels\HeroViewModel(dm_content_repo());
?>
<section class="section-mobile c-home-hero c-home-hero--direct" aria-labelledby="hero-title" style="background-image: linear-gradient(180deg, rgba(var(--dm-surface-0-rgb), 0.42), rgba(var(--dm-bg-0-rgb), 0.96)), url('<?php echo get_template_directory_uri(); ?>/assets/media/hero-energy.svg');">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 tw:lg:grid-cols-12 tw:gap-8 tw:items-end">
            <div class="tw:col-span-1 tw:lg:col-span-7">
                <div class="c-home-hero__copy">
                    <span class="c-home-eyebrow">Captura automática de datos operativos</span>
                    <h1 id="hero-title" class="c-home-hero__title"><?php echo esc_html($viewModel->getTitle()); ?></h1>
                    <p class="c-home-hero__subtitle"><?php echo esc_html($viewModel->getDescription()); ?></p>
                    <div class="c-home-hero__actions">
                        <button onclick="window.$chatwoot ? window.$chatwoot.toggle() : window.location.href='#contacto'" type="button" class="tw:btn-primary c-home-hero__primary"><?php echo esc_html($viewModel->getPrimaryCtaText()); ?></button>
                    </div>
                    <p class="c-home-hero__urgency" role="status">
                        <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
                        <span>Base operativa: Garín (GBA Norte). El alcance se define según tablero, señales disponibles, conectividad, sistema destino y objetivo operativo.</span>
                    </p>
                    <p class="c-home-hero__prefill"> WhatsApp abre con mensaje precargado para agilizar la asistencia. </p>
                    <div class="c-home-hero__trust-inline" aria-label="Capacidades destacadas">
                        <?php foreach ($viewModel->getTrustChips() as $chip) : ?>
                            <span class="c-home-hero__trust-chip"><?php echo esc_html($chip); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <ul class="c-home-hero__signals" aria-label="Condiciones operativas">
                        <?php foreach ($viewModel->getSignals() as $signal) : ?>
                            <li><?php echo esc_html($signal); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="tw:col-span-1 tw:lg:col-span-5 tw:hidden tw:lg:block">
                <article class="c-home-hero__media-card">
                    <p class="c-home-hero__media-label">Cobertura técnica activa</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/media/hero-energy.svg" alt="Captura e integración de datos energéticos y operativos en entorno industrial" class="c-home-hero__image" width="900" height="700" fetchpriority="high" loading="eager" decoding="async">
                </article>
            </div>
        </div>
    </div>
</section>
