<?php
/**
 * Template part for displaying the Profile section
 * Parity Refactor: Technical Bullets Structure
 */

$data = get_datamaq_site_data()['profile']; 
?>
<section id="perfil" class="section-mobile tw:py-24 tw:bg-[#0c092f]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-16 tw:items-center">
            
            <!-- Photo Column -->
            <div class="tw:col-span-12 lg:tw:col-span-12 xl:tw:col-span-12 2xl:tw:col-span-5 lg:tw:order-1">
                <article class="tw:flex tw:justify-center">
                    <img src="<?php echo esc_url($data['photo']); ?>" alt="<?php echo esc_attr($data['name']); ?>" class="tw:w-full tw:max-w-[480px] tw:aspect-square tw:rounded-[2.5rem] tw:border-4 tw:border-[#ff9a4d] tw:shadow-2xl tw:object-cover" loading="lazy">
                </article>
            </div>

            <!-- Content Column -->
            <div class="tw:col-span-12 lg:tw:col-span-12 xl:tw:col-span-12 2xl:tw:col-span-7 lg:tw:order-2">
                <span class="tw:inline-block tw:text-[#ff9a4d] tw:uppercase tw:tracking-[0.14em] tw:text-xs tw:font-black tw:mb-4">
                    <?php echo esc_html($data['eyebrow']); ?>
                </span>
                
                <h2 class="tw:text-5xl lg:tw:text-7xl tw:tracking-tighter tw:font-black tw:text-white tw:mb-6">
                    <?php echo esc_html($data['name']); ?>
                </h2>
                
                <p class="tw:inline-flex tw:items-center tw:px-4 tw:py-1.5 tw:rounded-full tw:bg-[#ff9a4d]/10 tw:text-[#ff9a4d] tw:font-black tw:uppercase tw:tracking-widest tw:text-sm tw:mb-10">
                    <?php echo esc_html($data['role']); ?>
                </p>

                <p class="tw:text-2xl lg:tw:text-4xl tw:text-white/95 tw:leading-tight tw:mb-12 tw:font-bold tw:tracking-tight">
                    <?php echo esc_html($data['lead']); ?>
                </p>

                <div class="tw:mb-14">
                    <p class="tw:text-[#ff9a4d] tw:uppercase tw:tracking-[0.12em] tw:text-xs tw:font-black tw:mb-8">
                        <?php echo esc_html($data['sectionLabel']); ?>
                    </p>
                    <ul class="tw:space-y-6 tw:p-0 tw:m-0 tw:list-none">
                        <?php foreach ($data['bullets'] as $bullet): ?>
                        <li class="tw:flex tw:items-start tw:gap-4 tw:text-white/80">
                            <span class="tw:mt-1.5 tw:w-2.5 tw:h-2.5 tw:bg-[#ff9a4d] tw:rounded-full tw:shrink-0 tw:shadow-[0_0_12px_rgba(255,154,77,0.4)]"></span>
                            <span class="tw:text-xl lg:tw:text-2xl tw:leading-snug"><?php echo esc_html($bullet); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="tw:flex tw:flex-wrap tw:gap-4">
                    <a href="<?php echo esc_url(get_datamaq_site_data()['brand']['whatsapp']); ?>" class="tw:btn-primary tw:px-10 tw:py-5 tw:text-xl tw:font-black">
                        <?php echo esc_html($data['whatsappLabel']); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
