<?php
/**
 * Template part for displaying the technical process section.
 */
try {
    $viewModel = new \DataMaq\UI\ViewModels\ProcessViewModel(dm_content_repo());
} catch (\Throwable $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo "<!-- Error in ProcessViewModel: " . esc_html($e->getMessage()) . " -->";
    }
    return;
}
?>
<section id="proceso" data-dm-component="ScrollReveal" class="section-mobile c-home-process" aria-labelledby="process-title" style="background: radial-gradient(circle at 10% 10%, rgba(255, 106, 0, 0.05) 0%, transparent 40%);">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="c-home-section-head tw:mb-16">
            <span class="c-home-eyebrow"><?php echo esc_html($viewModel->getEyebrow()); ?></span>
            <h2 id="process-title" class="c-home-section-title"><?php echo esc_html($viewModel->getTitle()); ?></h2>
        </div>

        <div class="c-home-process__grid tw:grid tw:grid-cols-1 md:tw:grid-cols-2 lg:tw:grid-cols-4 tw:gap-6">
            <?php foreach ($viewModel->getSteps() as $step) : ?>
                <article class="c-home-process-step tw:relative tw:p-8 tw:rounded-[2rem] tw:bg-[var(--dm-glass-bg)] tw:backdrop-blur-[var(--dm-glass-blur)] tw:border tw:border-white/5 hover:tw:border-[var(--dm-color-brand-primary)]/30 tw:transition-all tw:group">
                    <div class="c-home-process-step__header tw:mb-6">
                        <span class="c-home-process-step__number tw:block tw:text-5xl tw:font-bold tw:text-[var(--dm-color-brand-accent)]/10 group-hover:tw:text-[var(--dm-color-brand-accent)]/20 tw:transition-colors tw:mb-2">
                            <?php echo esc_html($step['order']); ?>
                        </span>
                        <h3 class="c-home-process-step__title tw:text-xl tw:font-bold tw:text-white">
                            <?php echo esc_html($step['title']); ?>
                        </h3>
                    </div>
                    <p class="c-home-process-step__description tw:text-[var(--dm-text-muted)] tw:text-sm tw:leading-relaxed">
                        <?php echo esc_html($step['description']); ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
