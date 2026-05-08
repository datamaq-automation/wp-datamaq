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
<section id="hero" data-dm-component="ScrollReveal" class="section-mobile c-home-hero c-home-hero--direct" aria-labelledby="hero-title" style="background-image: linear-gradient(180deg, rgba(12, 9, 47, 0.6), rgba(12, 9, 47, 0.98)), url('<?php echo esc_url($viewModel->getImageUrl()); ?>');">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-12 tw:items-center">
            
            <div class="tw:col-span-1 lg:tw:col-span-7">
                <div class="c-home-hero__copy tw:p-8 md:tw:p-12 tw:rounded-[2.5rem] tw:bg-[var(--dm-glass-bg)] tw:backdrop-blur-[var(--dm-glass-blur)] tw:border tw:border-white/10 tw:shadow-2xl">
                    <span class="c-home-eyebrow tw:mb-6"><?php echo esc_html($viewModel->getEyebrow()); ?></span>
                    <h1 id="hero-title" class="c-home-hero__title tw:text-4xl md:tw:text-6xl tw:font-black tw:tracking-tighter tw:leading-none tw:mb-6">
                        <?php echo esc_html($viewModel->getTitle()); ?>
                    </h1>
                    <p class="c-home-hero__subtitle tw:text-lg tw:text-[var(--dm-text-muted)] tw:mb-8 tw:max-w-2xl">
                        <?php echo esc_html($viewModel->getSubtitle()); ?>
                    </p>
                    
                    <div class="c-home-hero__actions tw:flex tw:flex-wrap tw:gap-4 tw:mb-8">
                        <a href="<?php echo esc_url($viewModel->getWhatsAppUrl()); ?>" class="tw:btn-primary c-home-hero__primary tw:inline-flex tw:items-center tw:gap-2 tw:px-8 tw:py-4 tw:rounded-full tw:bg-[var(--dm-color-brand-primary)] tw:text-[var(--dm-color-brand-secondary)] tw:font-bold tw:transition-transform hover:tw:scale-105">
                            <i class="bi bi-whatsapp"></i>
                            <?php echo esc_html($viewModel->getCtaLabel()); ?>
                        </a>
                    </div>

                    <div class="tw:flex tw:flex-col tw:gap-4">
                        <p class="c-home-hero__urgency tw:inline-flex tw:items-center tw:gap-2 tw:text-sm tw:font-semibold tw:text-white/90" role="status">
                            <i class="bi bi-lightning-charge-fill tw:text-[var(--dm-color-brand-accent)]" aria-hidden="true"></i>
                            <span><?php echo esc_html($viewModel->getStatusInfo()); ?></span>
                        </p>

                        <p class="c-home-hero__prefill tw:text-xs tw:text-white/50 tw:italic">
                            * WhatsApp abre con mensaje precargado para agilizar la asistencia.
                        </p>
                    </div>

                    <div class="c-home-hero__trust-inline tw:flex tw:flex-wrap tw:gap-3 tw:mt-10" aria-label="Capacidades destacadas">
                        <?php foreach ($viewModel->getTrustChips() as $chip) : ?>
                            <span class="c-home-hero__trust-chip tw:px-4 tw:py-2 tw:rounded-full tw:bg-white/5 tw:border tw:border-white/10 tw:text-xs tw:text-white/70">
                                <?php echo esc_html($chip); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="tw:col-span-1 lg:tw:col-span-5 tw:hidden lg:tw:block">
                <article class="c-home-hero__media-card tw:p-4 tw:rounded-[2.5rem] tw:bg-white/5 tw:backdrop-blur-sm tw:border tw:border-white/10 tw:rotate-2 hover:tw:rotate-0 tw:transition-transform tw:duration-500">
                    <p class="c-home-hero__media-label tw:text-[10px] tw:uppercase tw:tracking-[0.2em] tw:text-white/40 tw:mb-4 tw:ml-4">Cobertura técnica activa</p>
                    <img 
                        src="<?php echo esc_url($viewModel->getImageUrl()); ?>" 
                        alt="Captura e integración de datos energéticos y operativos en entorno industrial" 
                        class="c-home-hero__image tw:w-full tw:h-auto tw:rounded-[1.5rem] tw:shadow-2xl" 
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
