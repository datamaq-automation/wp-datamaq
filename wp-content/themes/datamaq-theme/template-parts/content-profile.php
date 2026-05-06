<?php
/**
 * Template part for displaying the profile section.
 */
try {
    $viewModel = new \DataMaq\UI\ViewModels\ProfileViewModel(dm_content_repo());
} catch (\Throwable $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo "<!-- Error in ProfileViewModel: " . esc_html($e->getMessage()) . " -->";
    }
    return; // Don't render the section if it fails
}
?>
<section id="perfil" data-dm-component="ScrollReveal" class="section-mobile c-home-profile" aria-labelledby="perfil-title">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 tw:lg:grid-cols-12 tw:gap-8 tw:items-stretch">
            
            <div class="tw:col-span-1 tw:lg:col-span-5">
                <article class="c-home-panel c-home-profile__card">
                    <span class="c-home-eyebrow">Perfil profesional</span>
                    <div class="c-home-profile__avatar-wrap tw:flex">
                        <img 
                            src="<?php echo esc_url($viewModel->getPhotoUrl()); ?>" 
                            alt="T&eacute;cnico a cargo de la implementaci&oacute;n" 
                            class="c-home-profile__avatar" 
                            width="700" 
                            height="933" 
                            loading="lazy" 
                            decoding="async"
                        >
                    </div>
                    <h2 id="perfil-title" class="c-home-profile__name"><?php echo esc_html($viewModel->getName()); ?></h2>
                    <p class="c-home-profile__role"><?php echo esc_html($viewModel->getRole()); ?></p>
                    <p><?php echo esc_html($viewModel->getIntroduction()); ?></p>
                    <button onclick="DataMaq.Chat.toggle()" type="button" class="tw:btn-primary c-home-profile__cta">Escribime directo por WhatsApp</button>
                </article>
            </div>

            <div class="tw:col-span-1 tw:lg:col-span-7">
                <article class="c-home-panel c-home-profile__details">
                    <p class="c-home-profile__section-label">Enfoque técnico</p>
                    <p class="c-home-profile__detail-copy"><?php echo esc_html($viewModel->getHowIWork()); ?></p>
                    
                    <div class="c-home-profile__benefits-grid">
                        <?php foreach ($viewModel->getItems() as $item) : ?>
                            <article class="c-home-profile__benefit-card">
                                <span class="c-home-profile__benefit-icon" aria-hidden="true">
                                    <i class="bi <?php echo esc_attr($viewModel->getBenefitIcon($item)); ?>"></i>
                                </span>
                                <p><?php echo esc_html($item); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </article>
            </div>

        </div>
    </div>
</section>
