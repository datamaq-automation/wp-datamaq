<?php
/**
 * Template part for displaying the profile section with V6 Absolute Parity.
 */
$data = get_datamaq_site_data();
$profile = $data['profile'];
?>
<section id="perfil" class="tw:py-32 tw:bg-gradient-to-b tw:from-[#0f1b3a] tw:to-[#0c092f] tw:relative tw:overflow-hidden">
    <!-- Vibrant ambient glow -->
    <div class="c-ambient-glow tw:bg-[#ff6a00] tw:bottom-[-20%] tw:left-[-10%] tw:opacity-[0.12]"></div>

    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-2 tw:gap-32 tw:items-center">
            
            <div class="tw:flex tw:justify-center">
                <div class="c-profile-image-container">
                    <img 
                        src="<?php echo esc_url($profile['photo']); ?>" 
                        alt="Agustin Bustos" 
                        class="c-profile-image tw:w-full tw:h-full tw:object-cover"
                    >
                    <div class="tw:absolute tw:inset-[-16px] tw:border tw:border-orange-400/20 tw:rounded-full tw:animate-[ping_5s_infinite]"></div>
                </div>
            </div>

            <div class="tw:space-y-12">
                <div>
                    <span class="c-home-hero__eyebrow">Perfil profesional</span>
                    <h2 class="tw:text-6xl md:tw:text-7xl tw:font-black tw:text-white tw:mb-10 tw:tracking-tighter">
                        Agustin Bustos
                    </h2>
                    <p class="tw:text-3xl tw:text-white/80 tw:leading-relaxed tw:max-w-2xl">
                        DataMaq trabaja sobre captura autom&aacute;tica de datos operativos, con foco en energ&iacute;a el&eacute;ctrica y producci&oacute;n.
                    </p>
                </div>

                <ul class="tw:space-y-10">
                    <li class="tw:flex tw:items-start tw:gap-8">
                        <span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:bg-orange-400/15 tw:rounded-xl tw:text-orange-400 tw:text-3xl">
                            <i class="bi bi-check-all"></i>
                        </span>
                        <div class="tw:flex-1">
                            <p class="tw:text-white/90 tw:text-2xl tw:leading-relaxed">Relevamiento en sitio y criterio de implementaci&oacute;n.</p>
                        </div>
                    </li>
                    <li class="tw:flex tw:items-start tw:gap-8">
                        <span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:bg-orange-400/15 tw:rounded-xl tw:text-orange-400 tw:text-3xl">
                            <i class="bi bi-check-all"></i>
                        </span>
                        <div class="tw:flex-1">
                            <p class="tw:text-white/90 tw:text-2xl tw:leading-relaxed">Instalaci&oacute;n, integraci&oacute;n y puesta en marcha para captura autom&aacute;tica de datos.</p>
                        </div>
                    </li>
                    <li class="tw:flex tw:items-start tw:gap-8">
                        <span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:bg-orange-400/15 tw:rounded-xl tw:text-orange-400 tw:text-3xl">
                            <i class="bi bi-check-all"></i>
                        </span>
                        <div class="tw:flex-1">
                            <p class="tw:text-white/90 tw:text-2xl tw:leading-relaxed">Asesoramiento y capacitaciones sobre Python, datos, bases de datos y APIs en contextos reales.</p>
                        </div>
                    </li>
                </ul>

                <div class="tw:pt-10">
                    <a href="https://wa.me/5491156297160" class="tw:btn-primary tw:px-14 tw:py-6 tw:text-xl tw:font-black">
                        Escribime directo por WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
