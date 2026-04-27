<?php
/**
 * Template part for displaying the FAQ section.
 */
try {
    $viewModel = new \DataMaq\UI\ViewModels\FaqViewModel(dm_content_repo());
} catch (\Throwable $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo "<!-- Error in FaqViewModel: " . esc_html($e->getMessage()) . " -->";
    }
    return;
}
?>
<section id="faq" data-dm-component="ScrollReveal" class="section-mobile c-home-faq" aria-labelledby="faq-title">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="c-home-section-head">
            <span class="c-home-eyebrow"><?php echo esc_html($viewModel->getEyebrow()); ?></span>
            <h2 id="faq-title" class="c-home-section-title"><?php echo esc_html($viewModel->getTitle()); ?></h2>
        </div>

        <div class="c-home-faq__stack">
            <?php foreach ($viewModel->getItems() as $faq) : ?>
                <details class="c-home-faq__item" <?php echo $faq->isOpen() ? 'open' : ''; ?>>
                    <summary class="c-home-faq__summary">
                        <span><?php echo esc_html($faq->getQuestion()); ?></span>
                        <span class="c-home-faq__toggle" aria-hidden="true">
                            <i class="bi bi-plus-lg"></i>
                        </span>
                    </summary>
                    <p class="c-home-faq__answer"><?php echo esc_html($faq->getAnswer()); ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
