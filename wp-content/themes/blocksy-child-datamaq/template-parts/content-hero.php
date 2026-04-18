<?php
/**
 * Template part for displaying the Hero section
 */

$data = get_datamaq_site_data()['hero']; 
?>
<section class="section-mobile c-home-hero tw:relative tw:bg-[#0c092f] tw:bg-center tw:bg-no-repeat tw:bg-cover tw:overflow-hidden" 
         style="background-image: linear-gradient(180deg, rgba(12, 9, 47, 0.42), rgba(12, 9, 47, 0.96)), url('<?php echo esc_url($data['image']); ?>'); padding-block: clamp(4rem, 10vw, 8rem); min-height: 90vh; display:flex; align-items:center;">
    <div class="tw:container tw:mx-auto tw:px-4 tw:relative tw:z-10">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-8">
            <div class="tw:col-span-12">
                <article class="c-home-hero__copy tw:p-8 lg:tw:p-14 tw:border tw:border-white/10 tw:rounded-[2.5rem] tw:bg-[#1a1c3d]/80 tw:backdrop-blur-xl tw:shadow-2xl">
                    <span class="c-home-eyebrow tw:inline-flex tw:items-center tw:rounded-full tw:px-4 tw:py-2 tw:mb-6 tw:bg-white/5 tw:text-[#ff9a4d] tw:text-[0.93rem] tw:font-black tw:uppercase tw:tracking-widest">
                        <?php echo esc_html($data['badge']); ?>
                    </span>
                    <h1 class="tw:m-0 tw:text-[clamp(2.5rem,7vw,5.5rem)] tw:leading-[0.85] tw:tracking-tighter tw:text-white" style="color:white !important;">
                        <?php echo esc_html($data['title']); ?>
                    </h1>
                    <p class="tw:max-w-[55ch] tw:mt-8 tw:text-white/85 tw:leading-relaxed tw:text-xl lg:tw:text-2xl">
                        <?php echo esc_html($data['subtitle']); ?>
                    </p>
                    <div class="tw:flex tw:flex-wrap tw:gap-6 tw:mt-10">
                        <a href="<?php echo esc_url($data['primaryCta']['href']); ?>" class="tw:btn-primary tw:px-12 tw:py-5 tw:text-xl tw:font-black tw:transition-transform hover:tw:scale-105">
                            <?php echo esc_html($data['primaryCta']['label']); ?>
                        </a>
                        <a href="<?php echo esc_url($data['secondaryCta']['href']); ?>" class="tw:btn-outline tw:px-12 tw:py-5 tw:text-xl tw:transition-colors hover:tw:bg-white/5">
                            <?php echo esc_html($data['secondaryCta']['label']); ?>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
