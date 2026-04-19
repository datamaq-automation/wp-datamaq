<?php
/**
 * Template part for displaying FAQ section.
 */
$data = get_datamaq_site_data();
$faq = $data['faq'];
?>
<section id="faq" class="tw:py-24 tw:bg-[#0c092f]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:max-w-3xl tw:mx-auto tw:text-center tw:mb-16">
            <span class="c-home-eyebrow">Dudas comunes</span>
            <h2 class="tw:text-4xl md:tw:text-5xl tw:font-black tw:text-white tw:mb-6">
                <?php echo esc_html($faq['title']); ?>
            </h2>
            <p class="tw:text-xl tw:text-[#99a9d1]">
                Todo lo que necesit&aacute;s saber sobre nuestras soluciones y metodolog&iacute;a.
            </p>
        </div>

        <div class="tw:max-w-4xl tw:mx-auto tw:space-y-4">
            <?php if (!empty($faq['items'])): ?>
                <?php foreach ($faq['items'] as $index => $item): ?>
                    <div class="c-faq-card tw:glass-card tw:glow-border">
                        <details class="tw:group">
                            <summary class="c-faq-card__header tw:list-none">
                                <h4 class="tw:font-bold tw:text-white tw:pr-8">
                                    <?php echo esc_html($item['q']); ?>
                                </h4>
                                <div class="c-faq-card__icon tw:transition-transform tw:duration-300 group-open:tw:rotate-45">
                                    <i class="bi bi-plus-lg"></i>
                                </div>
                            </summary>
                            <div class="c-faq-card__content tw:border-t tw:border-white/5 tw:pt-4">
                                <p><?php echo esc_html($item['a']); ?></p>
                            </div>
                        </details>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
