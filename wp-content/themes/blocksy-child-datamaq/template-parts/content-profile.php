<?php
/**
 * Template part for displaying the profile section.
 */
$data = get_datamaq_site_data();
$profile = $data['profile'];
?>
<section id="perfil" class="tw:py-24 tw:bg-gradient-to-b tw:from-[#0f1b3a] tw:to-[#0c092f]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-2 tw:gap-16 tw:items-center">
            
            <!-- Image Column with Circular Parity -->
            <div class="tw:relative">
                <div class="c-profile-image-container">
                    <?php if (!empty($profile['photo'])): ?>
                        <img 
                            src="<?php echo esc_url($profile['photo']); ?>" 
                            alt="<?php echo esc_attr($profile['name']); ?>" 
                            class="c-profile-image"
                        >
                    <?php endif; ?>
                </div>
                <!-- Subtle background glow -->
                <div class="tw:absolute tw:inset-0 tw:bg-[#ff9a4d] tw:opacity-10 tw:blur-[80px] -tw:z-10 tw:rounded-full"></div>
            </div>

            <!-- Content Column -->
            <div class="tw:space-y-8">
                <div>
                    <?php if (!empty($profile['eyebrow'])): ?>
                        <span class="c-home-eyebrow"><?php echo esc_html($profile['eyebrow']); ?></span>
                    <?php endif; ?>
                    <h2 class="tw:text-4xl md:tw:text-5xl tw:font-black tw:text-white tw:mb-6">
                        <?php echo esc_html($profile['name']); ?>
                    </h2>
                    <p class="tw:text-xl tw:text-[#99a9d1] tw:leading-relaxed">
                        <?php echo esc_html($profile['lead']); ?>
                    </p>
                </div>

                <ul class="c-profile-list tw:space-y-6">
                    <?php if (!empty($profile['bullets'])): ?>
                        <?php foreach ($profile['bullets'] as $bullet_text): ?>
                            <li class="tw:flex tw:items-start">
                                <i class="bi bi-check-all"></i>
                                <div>
                                    <p class="tw:text-[#99a9d1] tw:text-lg"><?php echo esc_html($bullet_text); ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>

                <div class="tw:pt-6">
                    <a href="<?php echo esc_url($data['brand']['whatsapp']); ?>" class="tw:btn-primary">
                        <?php echo esc_html($profile['whatsappLabel'] ?? 'Agendar entrevista t??cnica'); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
