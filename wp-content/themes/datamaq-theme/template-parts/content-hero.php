<?php
/**
 * Template part for displaying the hero section.
 */
try {
    $viewModel = new \DataMaq\UI\ViewModels\HeroViewModel(dm_content_repo());
} catch (\Throwable $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo "<!-- Error in HeroViewModel: " . esc_html($e->getMessage()) . " -->";
    }
    return;
}
?>
<section id="hero" data-dm-component="ScrollReveal" class="section-mobile c-home-hero c-home-hero--direct" aria-labelledby="hero-title" style="background-image: linear-gradient(180deg, rgba(12, 9, 47, 0.42), rgba(12, 9, 47, 0.96)), url('<?php echo esc_url($viewModel->getImageUrl()); ?>');">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 tw:lg:grid-cols-12 tw:gap-8 tw:items-end">
            
            <div class="tw:col-span-1 tw:lg:col-span-7">
                <div class="c-home-hero__copy">
                    <span class="c-home-eyebrow"><?php echo esc_html($viewModel->getEyebrow()); ?></span>
                    <h1 id="hero-title" class="c-home-hero__title"><?php echo esc_html($viewModel->getTitle()); ?></h1>
                    <p class="c-home-hero__subtitle"><?php echo esc_html($viewModel->getSubtitle()); ?></p>
                    
                    <div class="c-home-hero__actions">
                        <button onclick="window.location.href='<?php echo esc_url($viewModel->getWhatsAppUrl()); ?>'" type="button" class="tw:btn-primary c-home-hero__primary"><?php echo esc_html($viewModel->getCtaLabel()); ?></button>
                    </div>

                    <p class="c-home-hero__urgency" role="status">
                        <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
                        <span><?php echo esc_html($viewModel->getStatusInfo()); ?></span>
                    </p>

                    <p class="c-home-hero__prefill"> WhatsApp abre con mensaje precargado para agilizar la asistencia. </p>

                    <div class="c-home-hero__trust-inline" aria-label="Capacidades destacadas">
                        <?php foreach ($viewModel->getTrustChips() as $chip) : ?>
                            <span class="c-home-hero__trust-chip"><?php echo esc_html($chip); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="tw:col-span-1 tw:lg:col-span-5 tw:hidden tw:lg:block">
                <article class="c-home-hero__media-card">
                    <p class="c-home-hero__media-label">Cobertura técnica activa</p>
                    <img 
                        src="<?php echo esc_url($viewModel->getImageUrl()); ?>" 
                        alt="Captura e integraci&oacute;n de datos energ&eacute;ticos y operativos en entorno industrial" 
                        class="c-home-hero__image" 
                        width="900" 
                        height="700" 
                        fetchpriority="high" 
                        loading="eager" 
                        decoding="async"
                    >
                </article>
            </div>

        </div>
    </div>
</section>
