<?php
/**
 * Template part for displaying FAQ section.
 */
$viewModel = new \DataMaq\UI\ViewModels\FaqViewModel(dm_content_repo());
?>
<section id="faq" data-dm-component="ScrollReveal" class="c-home-faq tw:bg-[#0c092f] tw:relative tw:overflow-hidden">
    <!-- Vibrant ambient glow -->
    <div class="c-ambient-glow tw:bg-[#ff6a00] tw:top-[-20%] tw:left-[-10%] tw:opacity-[0.1]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:max-w-5xl tw:mx-auto tw:text-center tw:mb-24">
            <span class="dm-eyebrow">
                <?php echo esc_html($viewModel->getEyebrow()); ?>
            </span>
            <h2 class="tw:text-6xl lg:tw:text-8xl tw:font-black tw:mb-10 tw:tracking-tighter">
                <?php echo esc_html($viewModel->getTitle()); ?>
            </h2>
            <p class="tw:text-3xl /60">
                <?php echo esc_html($viewModel->getIntro()); ?>
            </p>
        </div>

        <div class="tw:max-w-5xl tw:mx-auto tw:space-y-8">
            <?php foreach ($viewModel->getItems() as $item) : ?>
            <div class="c-home-faq__item dm-faq-item tw:glow-orange">
                <details class="tw:group">
                    <summary class="tw:p-12 tw:list-none tw:flex tw:justify-between tw:items-center tw:cursor-pointer">
                        <h4 class="tw:font-black tw:text-3xl tw:pr-12 tw:tracking-tight">
                            <?php echo esc_html($item['q']); ?>
                        </h4>
                        <div class="tw:text-orange-400 tw:text-4xl tw:transition-transform tw:duration-300 group-open:tw:rotate-45">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </summary>
                    <div class="tw:p-12 tw:pt-0 tw:border-t tw:border-white/5">
                        <p class="/80 tw:text-2xl tw:leading-relaxed">
                            <?php echo esc_html($item['a']); ?>
                        </p>
                    </div>
                </details>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



