<?php
/**
 * Template part for displaying the Profile section
 */

$data = get_datamaq_site_data()['profile']; 
?>
<section id="perfil" class="section-mobile tw:py-24 tw:bg-[#0c092f]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-16 tw:items-center">
            <div class="tw:col-span-12 lg:tw:col-span-5">
                <article class="tw:flex tw:justify-center">
                    <img src="<?php echo esc_url($data['photo']); ?>" alt="<?php echo esc_attr($data['name']); ?>" class="tw:w-full tw:max-w-[480px] tw:aspect-square tw:rounded-[2.5rem] tw:border-4 tw:border-[#ff9a4d] tw:shadow-2xl tw:object-cover" loading="lazy">
                </article>
            </div>
            <div class="tw:col-span-12 lg:tw:col-span-7">
                <h2 class="tw:text-5xl lg:tw:text-6xl tw:tracking-tighter tw:text-white tw:mb-6"><?php echo esc_html($data['name']); ?></h2>
                <p class="tw:text-[#ff9a4d] tw:font-black tw:uppercase tw:tracking-widest tw:text-xl tw:mb-8"><?php echo esc_html($data['role']); ?></p>
                <p class="tw:text-2xl lg:tw:text-3xl tw:text-white/95 tw:leading-tight tw:mb-10 tw:font-medium"><?php echo esc_html($data['lead']); ?></p>
                <p class="tw:text-white/70 tw:text-lg tw:leading-relaxed tw:mb-10"><?php echo esc_html($data['detail']); ?></p>
                <a href="https://wa.me/5491156297160" class="tw:btn-primary tw:px-12 tw:py-4 tw:text-lg">Hablar con Agustín</a>
            </div>
        </div>
    </div>
</section>
