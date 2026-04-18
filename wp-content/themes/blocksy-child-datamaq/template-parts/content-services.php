<?php
/**
 * Template part for displaying the Services section
 */

$data = get_datamaq_site_data()['services']; 
?>
<section id="servicios" class="section-mobile tw:py-24 tw:bg-[#111229]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <h2 class="tw:text-5xl lg:tw:text-6xl tw:tracking-tighter tw:text-white tw:mb-16">
            <?php echo esc_html($data['title']); ?>
        </h2>
        <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-3 tw:gap-10">
            <?php foreach ($data['cards'] as $card): ?>
            <article class="tw:p-12 tw:bg-[#1a1c3d]/60 tw:backdrop-blur-md tw:border tw:border-white/10 tw:rounded-[2.5rem] tw:shadow-xl tw:transition-all hover:tw:border-[#ff9a4d]/50 hover:tw:translate-y-[-8px]">
                <h3 class="tw:text-2xl tw:font-bold tw:text-white tw:mb-2"><?php echo esc_html($card['title']); ?></h3>
                <p class="tw:text-[#ff9a4d] tw:font-bold tw:mb-6 tw:uppercase tw:tracking-wider tw:text-xs"><?php echo esc_html($card['subtitle']); ?></p>
                <ul class="tw:space-y-4 tw:mb-12">
                    <?php foreach ($card['items'] as $item): ?>
                    <li class="tw:flex tw:items-start tw:gap-3 tw:text-white/85">
                        <span class="tw:mt-1.5 tw:w-2 tw:h-2 tw:bg-[#ff9a4d] tw:rounded-full tw:shrink-0"></span>
                        <span class="tw:text-lg"><?php echo esc_html($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url($card['cta']['href']); ?>" class="tw:btn-outline tw:w-full tw:text-center">
                    <?php echo esc_html($card['cta']['label']); ?>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
