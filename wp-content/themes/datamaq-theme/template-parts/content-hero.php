<?php
/**
 * Template part for displaying the hero section.
 * Refactored to use ViewModel Pattern.
 */
$viewModel = new \DataMaq\UI\ViewModels\HeroViewModel(dm_content_repo());
?>
<section id="hero" data-dm-component="ScrollReveal" class="section-mobile c-home-hero c-home-hero--direct" aria-labelledby="hero-title" style="background-image: linear-gradient(180deg, rgba(12, 9, 47, 0.42), rgba(12, 9, 47, 0.96)), url('<?php echo esc_url($viewModel->getImageUrl()); ?>');">
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
            </div>

            <div class="tw:relative lg:tw:block tw:hidden">
                <div class="tw:glass-card-intensive tw:p-6 tw:rounded-[4rem] tw:shadow-2xl">
                    <img 
                        src="<?php echo $viewModel->getImageUrl(); ?>" 
                        alt="<?php echo esc_attr($viewModel->getTitle()); ?>" 
                        class="tw:w-full tw:h-auto tw:rounded-[3.2rem]"
                    >
                </div>
                <div class="tw:absolute -tw:bottom-8 -tw:left-8 tw:glass-card-intensive tw:p-10 tw:rounded-3xl tw:shadow-2xl tw:border-orange-400/30">
                    <div class="tw:flex tw:items-center tw:gap-6">
                        <div class="tw:w-4 tw:h-4 tw:bg-green-500 tw:rounded-full tw:animate-pulse"></div>
                        <span class=" tw:font-black tw:text-lg tw:uppercase tw:tracking-widest">Estado: Online</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
