<?php
/**
 * Template part for displaying the FAQ section
 */

$faq = get_datamaq_site_data()['faq']; 
?>
<section id="faq" class="section-mobile tw:py-32 tw:bg-[#111229]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <h2 class="tw:text-5xl tw:tracking-tighter tw:text-white tw:mb-16">
            <?php echo esc_html($faq['title']); ?>
        </h2>
        <div class="tw:max-w-4xl tw:space-y-6">
            <?php foreach ($faq['items'] as $item): ?>
            <details class="tw:group tw:p-6 tw:bg-[#1a1c3d] tw:rounded-[2rem] tw:border tw:border-white/10 tw:transition-colors open:tw:border-[#ff9a4d]/30">
                <summary class="tw:text-2xl tw:font-bold tw:text-white tw:cursor-pointer tw:flex tw:justify-between tw:items-center list-none tw:pl-6">
                    <?php echo esc_html($item['q']); ?>
                    <span class="tw:text-[#ff9a4d] tw:text-3xl tw:transition-transform group-open:tw:rotate-45">+</span>
                </summary>
                <div class="tw:mt-6 tw:text-white/70 tw:text-xl tw:leading-relaxed">
                    <?php echo esc_html($item['a']); ?>
                </div>
            </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
