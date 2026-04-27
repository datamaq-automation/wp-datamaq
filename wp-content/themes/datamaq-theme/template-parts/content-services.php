<?php
/**
 * Template part for displaying services section.
 */
$viewModel = new \DataMaq\UI\ViewModels\ServicesViewModel(dm_content_repo());
?>
<section id="servicios" data-dm-component="ScrollReveal" class="c-home-services tw:bg-[#111229] tw:relative tw:overflow-hidden">
    <!-- Vibrant ambient glow -->
    <div class="c-ambient-glow tw:bg-[#4299e1] tw:top-[-20%] tw:right-[-10%]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:max-w-5xl tw:mb-24">
            <span class="dm-eyebrow">
                <?php echo esc_html($viewModel->getEyebrow()); ?>
            </span>
            <h2 class="c-home-section-title tw:text-6xl lg:tw:text-8xl tw:font-black tw:mb-10 tw:tracking-tighter">
                <?php echo esc_html($viewModel->getTitle()); ?>
            </h2>
            <p class="c-home-section-copy tw:text-3xl /60 tw:leading-relaxed tw:max-w-3xl">
                <?php echo esc_html($viewModel->getIntro()); ?>
            </p>
        </div>

        <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-3 tw:gap-14">
            <?php foreach ($viewModel->getCards() as $card) : ?>
            <article class="c-home-service-card tw:p-14 tw:glass-card-intensive tw:rounded-[4rem] tw:flex tw:flex-col tw:transition-all tw:group">
                <div class="tw:flex-1">
                    <h3 class="tw:text-3xl tw:font-black tw:mb-4"><?php echo esc_html($card['title']); ?></h3>
                    <p class="tw:text-orange-400 tw:text-sm tw:font-black tw:uppercase tw:tracking-[0.3em] tw:mb-12"><?php echo esc_html($card['subtitle']); ?></p>
                    <ul class="tw:space-y-6 tw:mb-16">
                        <?php foreach ($card['items'] as $item) : ?>
                        <li class="tw:flex tw:items-start tw:gap-5 /80 tw:text-xl">
                            <span class="tw:mt-3 tw:w-3 tw:h-3 tw:bg-orange-400 tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(251,146,60,0.6)]"></span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="tw:pt-8">
                    <a href="<?php echo esc_url($card['cta']['href']); ?>" class="dm-btn-outline tw:w-full tw:text-xl">
                        <?php echo esc_html($card['cta']['label']); ?>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

