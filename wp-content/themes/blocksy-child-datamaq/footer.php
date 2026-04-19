<?php
/**
 * Template part for displaying the footer with V6 Absolute Parity.
 */
$data = get_datamaq_site_data();
?>
    <footer class="c-home-footer tw:bg-[#0c092f] tw:py-16 tw:border-t tw:border-white/5">
        <div class="tw:container tw:mx-auto tw:px-4">
            <div class="c-home-footer__shell tw:flex tw:flex-col lg:tw:flex-row tw:justify-between tw:items-center tw:gap-8">
                <!-- Left: Brand & Note -->
                <div class="tw:text-center lg:tw:text-left">
                    <p class="tw:text-2xl tw:font-black tw:text-white tw:mb-1"><?php echo $data['brand']['name']; ?></p>
                    <p class="tw:text-white/40 tw:text-sm">
                        &copy; <?php echo date('Y'); ?> <?php echo $data['brand']['base']; ?>
                    </p>
                </div>

                <!-- Center: Legal -->
                <div class="lg:tw:max-w-2xl tw:text-center">
                    <p class="tw:text-white/30 tw:text-xs tw:leading-relaxed">
                        <?php echo $data['legal']['text']; ?>
                    </p>
                </div>

                <!-- Right: CTA -->
                <div class="tw:text-center lg:tw:text-right">
                    <a href="<?php echo esc_url($data['brand']['whatsapp']); ?>" class="tw:text-orange-400 tw:font-bold tw:text-lg hover:tw:text-orange-300 tw:transition-colors">
                        <?php echo $data['navbar']['contactLabel'] ?? 'Escribime'; ?>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- MOBILE PARITY DOCK V6 -->
    <nav class="c-home-dock lg:tw:hidden tw:fixed tw:bottom-0 tw:left-0 tw:right-0 tw:bg-[#0c092f]/90 tw:backdrop-blur-lg tw:border-t tw:border-white/10 tw:z-[5000] tw:flex tw:justify-around tw:py-4">
        <a href="#top" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/50 hover:tw:text-orange-400 tw:transition-colors">
            <i class="bi bi-house-door tw:text-xl"></i>
            <span class="tw:text-[10px] tw:font-bold tw:uppercase tw:tracking-wider">Inicio</span>
        </a>
        <a href="#servicios" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/50 hover:tw:text-orange-400 tw:transition-colors">
            <i class="bi bi-lightning-charge tw:text-xl"></i>
            <span class="tw:text-[10px] tw:font-bold tw:uppercase tw:tracking-wider">Soluci&oacute;n</span>
        </a>
        <a href="#perfil" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/50 hover:tw:text-orange-400 tw:transition-colors">
            <i class="bi bi-person tw:text-xl"></i>
            <span class="tw:text-[10px] tw:font-bold tw:uppercase tw:tracking-wider">Perfil</span>
        </a>
        <a href="#contacto" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/50 hover:tw:text-orange-400 tw:transition-colors">
            <i class="bi bi-chat-dots tw:text-xl"></i>
            <span class="tw:text-[10px] tw:font-bold tw:uppercase tw:tracking-wider">Contacto</span>
        </a>
    </nav>

    <!-- FABs -->
    <a href="https://wa.me/5491156297160" id="whatsapp-fab" class="tw:fixed tw:right-8 tw:bottom-24 tw:w-16 tw:h-16 tw:bg-[#25d366] tw:text-white tw:rounded-full tw:flex tw:items-center tw:justify-center tw:text-3xl tw:shadow-2xl tw:z-[4999] hover:tw:scale-110 tw:transition-all">
        <i class="bi bi-whatsapp"></i>
    </a>

    <?php wp_footer(); ?>
</body>
</html>

