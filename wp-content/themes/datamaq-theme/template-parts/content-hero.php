<?php
/**
 * Template part for displaying the hero section.
 * Refactored to use ViewModel Pattern.
 */
$viewModel = new \DataMaq\UI\ViewModels\HeroViewModel(dm_content_repo());
?>
<section id="hero" data-dm-component="ScrollReveal" class="c-home-hero tw:relative tw:min-h-screen tw:flex tw:items-center tw:py-40 tw:overflow-hidden tw:bg-[#0c092f]">
    <div class="c-ambient-glow tw:bg-[#ff6a00] tw:top-[-10%] tw:left-[-10%]"></div>
    <div class="c-ambient-glow tw:bg-[#4299e1] tw:bottom-[-20%] tw:right-[-10%] tw:opacity-[0.08]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-2 tw:gap-24 tw:items-center">
            
            <div class="tw:max-w-4xl">
                <span class="dm-eyebrow">Captura autom&aacute;tica de datos operativos</span>
                <h1 class="c-home-hero__title tw:text-white tw:mb-10 tw:text-5xl md:tw:text-7xl">
                    <?php echo esc_html($viewModel->getTitle()); ?>
                </h1>
                <p class="tw:text-xl md:tw:text-2xl tw:text-white/85 tw:leading-relaxed tw:mb-14 tw:max-w-2xl">
                    <?php echo esc_html($viewModel->getDescription()); ?>
                </p>
                <div class="tw:flex tw:flex-col md:tw:flex-row tw:gap-6">
                    <button onclick="window.$chatwoot.toggle()" class="dm-btn-primary tw:px-12 tw:py-6 tw:text-xl">
                        <?php echo esc_html($viewModel->getPrimaryCtaText()); ?>
                    </button>
                    <a href="#servicios" class="dm-btn-outline tw:px-12 tw:py-6 tw:text-xl">
                        <?php echo esc_html($viewModel->getSecondaryCtaText()); ?>
                    </a>
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
                        <span class="tw:text-white tw:font-black tw:text-lg tw:uppercase tw:tracking-widest">Estado: Online</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
