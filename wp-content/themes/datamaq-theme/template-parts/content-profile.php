<?php
/**
 * Template part for displaying the profile section with V6 Absolute Parity.
 */
$data = get_datamaq_site_data();
$about = $data['about'];
$profile = $data['profile'];

function get_profile_benefit_icon($text) {
    $normalized = strtolower($text);
    $icons = [
        'ahorro' => 'bi-cash-coin',
        'prevent' => 'bi-shield-check',
        'diagn' => 'bi-activity',
        'tiempo' => 'bi-stopwatch',
        'parada' => 'bi-lightning-charge-fill',
        'repuesto' => 'bi-box-seam'
    ];
    foreach ($icons as $keyword => $icon) {
        if (strpos($normalized, $keyword) !== false) return $icon;
    }
    return 'bi-check2-circle';
}
?>
<section id="perfil" data-dm-component="ScrollReveal" class="section-mobile c-home-profile tw:py-24 tw:relative tw:overflow-hidden" aria-labelledby="perfil-title">
    <!-- Blue Ambient Glow for V6 feel -->
    <div class="c-ambient-glow c-ambient-glow--blue tw:top-[-20%] tw:right-[-10%] tw:w-[60vw] tw:h-[60vw]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-12 tw:gap-8 tw:items-stretch">
            
            <!-- Left Col: Profile Card -->
            <div class="tw:col-span-1 lg:tw:col-span-5">
                <article class="dm-panel tw:h-full tw:p-8 tw:flex tw:flex-col tw:items-start">
                    <span class="dm-eyebrow">EL PERFIL DEL T&Eacute;CNICO</span>
                    <div class="c-home-profile__avatar-wrap tw:w-full tw:flex tw:justify-center tw:mb-8">
                        <img 
                            src="<?php echo esc_url($profile['photo']); ?>" 
                            alt="Agustin Bustos" 
                            class="c-home-profile__avatar tw:w-60 tw:h-60 tw:object-cover tw:rounded-full tw:border-2 tw:border-[#ff6a00]/70 tw:shadow-2xl"
                        >
                    </div>
                    <h2 id="perfil-title" class="c-home-profile__name tw:text-4xl tw:font-black tw:text-white tw:mb-2 tw:tracking-tighter">Agustin Bustos</h2>
                    <p class="c-home-profile__role tw:text-[#ff6a00] tw:font-bold tw:uppercase tw:tracking-wider tw:text-sm tw:mb-6">T&eacute;cnico en Automatizaci&oacute;n y Datos</p>
                    <p class="tw:text-white/70 tw:leading-relaxed tw:mb-8">
                        DataMaq trabaja sobre captura autom&aacute;tica de datos operativos, con foco en energ&iacute;a el&eacute;ctrica y producci&oacute;n.
                    </p>
                    <a href="https://wa.me/5491156297160" class="dm-btn-primary tw:w-full tw:py-4">
                        Escribime directo por WhatsApp
                    </a>
                </article>
            </div>

            <!-- Right Col: Benefits and Details -->
            <div class="tw:col-span-1 lg:tw:col-span-7">
                <article class="dm-panel tw:h-full tw:p-8">
                    <p class="c-home-profile__section-label tw:text-white/40 tw:uppercase tw:tracking-[0.18em] tw:text-[0.7rem] tw:font-bold tw:mb-6">C&Oacute;MO TRABAJO</p>
                    <p class="c-home-profile__detail-copy tw:text-white/80 tw:leading-relaxed tw:mb-12">
                        Relevamiento en sitio y criterio de implementaci&oacute;n. Instalaci&oacute;n, integraci&oacute;n y puesta en marcha para captura autom&aacute;tica de datos.
                    </p>
                    
                    <div class="c-home-profile__benefits-grid tw:grid tw:gap-4 md:tw:grid-cols-2">
                        <?php foreach ($profile['items'] as $item) : ?>
                            <article class="c-home-profile__benefit-card tw:flex tw:items-start tw:gap-4 tw:p-4 tw:rounded-2xl tw:bg-white/5 tw:border tw:border-white/10">
                                <span class="c-home-profile__benefit-icon tw:flex tw:items-center tw:justify-center tw:w-10 tw:h-10 tw:rounded-lg tw:bg-[#ff6a00]/10 tw:text-[#ff6a00] tw:text-xl">
                                    <i class="bi <?php echo get_profile_benefit_icon($item); ?>"></i>
                                </span>
                                <p class="tw:text-sm tw:text-white/90 tw:leading-tight tw:m-0"><?php echo esc_html($item); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </article>
            </div>

        </div>
    </div>
</section>
