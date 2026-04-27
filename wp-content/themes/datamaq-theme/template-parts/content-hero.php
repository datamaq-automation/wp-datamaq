<?php
/**
 * Template part for displaying the hero section.
 * Refactored to use ViewModel Pattern.
 */
$viewModel = new \DataMaq\UI\ViewModels\HeroViewModel(dm_content_repo());
?>
<section id="hero" data-dm-component="ScrollReveal" class="section-mobile c-home-hero c-home-hero--direct" aria-labelledby="hero-title" style="background-image: linear-gradient(180deg, rgba(12, 9, 47, 0.42), rgba(12, 9, 47, 0.96)), url('<?php echo get_template_directory_uri(); ?>/assets/media/hero-energy.svg');">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 tw:lg:grid-cols-12 tw:gap-8 tw:items-end">
            
            <div class="tw:col-span-1 tw:lg:col-span-7">
                <div class="c-home-hero__copy">
                    <span class="c-home-eyebrow">Captura autom&aacute;tica de datos operativos</span>
                    <h1 id="hero-title" class="c-home-hero__title">
                        <?php echo esc_html($viewModel->getTitle()); ?>
                    </h1>
                    <p class="c-home-hero__subtitle">
                        <?php echo esc_html($viewModel->getDescription()); ?>
                    </p>
                    <div class="c-home-hero__actions">
                        <button onclick="window.$chatwoot ? window.$chatwoot.toggle() : window.location.href='#contacto'" type="button" class="tw:btn-primary c-home-hero__primary">
                            <?php echo esc_html($viewModel->getPrimaryCtaText()); ?>
                        </button>
                    </div>
                    
                    <p class="c-home-hero__urgency" role="status">
                        <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
                        <span>Base operativa: Gar&iacute;n (GBA Norte). El alcance se define seg&uacute;n tablero, se&ntilde;ales disponibles, conectividad, sistema destino y objetivo operativo.</span>
                    </p>
                    <p class="c-home-hero__prefill"> WhatsApp abre con mensaje precargado para agilizar la asistencia. </p>
                    
                    <div class="c-home-hero__trust-inline" aria-label="Capacidades destacadas">
                        <span class="c-home-hero__trust-chip">Base operativa: Gar&iacute;n (GBA Norte). El alcance se define seg&uacute;n tablero, se&ntilde;ales disponibles, conectividad, sistema destino y objetivo operativo.</span>
                        <span class="c-home-hero__trust-chip">Instalaci&oacute;n de equipos IoT para captura de datos</span>
                        <span class="c-home-hero__trust-chip">Asesoramiento t&eacute;cnico para an&aacute;lisis de datos</span>
                    </div>
                    
                    <ul class="c-home-hero__signals" aria-label="Condiciones operativas">
                        <li>Base operativa: Gar&iacute;n (GBA Norte). El alcance se define seg&uacute;n tablero, se&ntilde;ales disponibles, conectividad, sistema destino y objetivo operativo.</li>
                    </ul>
                </div>
            </div>

            <div class="tw:col-span-1 tw:lg:col-span-5 tw:hidden tw:lg:block">
                <article class="c-home-hero__media-card">
                    <p class="c-home-hero__media-label">Cobertura t&eacute;cnica activa</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/media/hero-energy.svg" alt="<?php echo esc_attr($viewModel->getTitle()); ?>" class="c-home-hero__image" width="900" height="700" fetchpriority="high" loading="eager" decoding="async">
                </article>
            </div>
            
        </div>
    </div>
</section>
