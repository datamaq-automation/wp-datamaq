<?php
/**
 * Template part for displaying the Proceso section
 */

$process = get_datamaq_site_data()['process']; 
?>
<section id="proceso" class="section-mobile tw:py-24 tw:bg-[#0c092f]">
    <div class="tw:container tw:mx-auto tw:px-4">
         <h2 class="tw:text-5xl tw:tracking-tighter tw:text-white tw:mb-16">
            <?php echo esc_html($process['title']); ?>
         </h2>
         <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-4 tw:gap-14">
            <?php foreach ($process['steps'] as $step): ?>
            <article class="tw:group tw:relative">
                <!-- Parity Fix: Ultra-subtle background numbers -->
                <span class="tw:text-8xl tw:font-black tw:text-white/[0.03] tw:mb-4 tw:block tw:transition-colors group-hover:tw:text-[#ff9a4d]/10">
                    <?php echo esc_html($step['order']); ?>
                </span>
                <h3 class="tw:text-2xl tw:font-bold tw:text-white tw:mb-4"><?php echo esc_html($step['title']); ?></h3>
                <p class="tw:text-white/60 tw:text-lg tw:leading-relaxed"><?php echo esc_html($step['desc']); ?></p>
            </article>
            <?php endforeach; ?>
         </div>
    </div>
</section>
