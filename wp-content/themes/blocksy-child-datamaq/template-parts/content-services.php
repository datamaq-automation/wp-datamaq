<?php
/**
 * Template part for displaying services section.
 */
$data = get_datamaq_site_data();
$services = $data['services'];
?>
<section id="servicios" class="tw:py-24 tw:bg-[#0c092f] tw:relative tw:overflow-hidden">
    <!-- Background element -->
    <div class="tw:absolute tw:top-0 tw:right-0 tw:w-[500px] tw:height-[500px] tw:bg-[#ff6a00] tw:opacity-[0.03] tw:blur-[100px] -tw:z-10"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:max-w-3xl tw:mb-16">
            <span class="c-home-eyebrow">Nuestras Soluciones</span>
            <h2 class="tw:text-4xl md:tw:text-5xl tw:font-black tw:text-white tw:mb-6">
                <?php echo esc_html($services['title']); ?>
            </h2>
            <p class="tw:text-xl tw:text-[#99a9d1]">
                Optimizamos la eficiencia operativa mediante tecnolog&iacute;a de vanguardia y an&aacute;lisis de datos en tiempo real.
            </p>
        </div>

        <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-2 lg:tw:grid-cols-3 tw:gap-8">
            <?php if (!empty($services['cards'])): ?>
                <?php foreach ($services['cards'] as $card): ?>
                    <div class="c-service-card tw:glass-card tw:glow-border tw:p-8 tw:rounded-[1.5rem] tw:flex tw:flex-col tw:gap-6">
                        <div class="tw:w-14 tw:h-14 tw:bg-[#ff9a4d]/10 tw:rounded-xl tw:flex tw:items-center tw:justify-center tw:text-[#ff9a4d] tw:text-2xl">
                            <i class="bi <?php echo esc_attr($card['icon'] ?? 'bi-cpu'); ?>"></i>
                        </div>
                        <div class="tw:flex-1">
                            <h3 class="tw:text-xl tw:font-bold tw:text-white tw:mb-2"><?php echo esc_html($card['title']); ?></h3>
                            <p class="tw:text-[#ff9a4d] tw:text-sm tw:font-bold tw:uppercase tw:tracking-wider tw:mb-4"><?php echo esc_html($card['subtitle']); ?></p>
                            
                            <ul class="tw:space-y-3 tw:mb-8">
                                <?php foreach ($card['items'] as $feature): ?>
                                    <li class="tw:flex tw:items-start tw:gap-2 tw:text-[#99a9d1] tw:text-sm">
                                        <i class="bi bi-circle-fill tw:text-[6px] tw:mt-1.5 tw:text-[#ff9a4d]/60"></i>
                                        <span><?php echo esc_html($feature); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div>
                            <a href="<?php echo esc_url($card['cta']['href']); ?>" class="tw:text-white tw:font-bold hover:tw:text-[#ff9a4d] tw:transition-colors tw:flex tw:items-center tw:gap-2">
                                <?php echo esc_html($card['cta']['label']); ?>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
