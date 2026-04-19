<?php
/**
 * Template part for displaying the footer with V6 Absolute Parity.
 */
$data = get_datamaq_site_data();
?>
    <footer class="tw:bg-[#0c092f] tw:py-24 tw:border-t tw:border-white/5">
        <div class="tw:container tw:mx-auto tw:px-4">
            <div class="tw:flex tw:flex-col md:tw:flex-row tw:justify-between tw:items-center tw:gap-12">
                <div class="tw:text-center md:tw:text-left">
                    <h2 class="tw:text-3xl tw:font-black tw:text-white tw:mb-4">DataMaq</h2>
                    <p class="tw:text-white/60 tw:text-lg">Captura autom&aacute;tica de datos operativos</p>
                </div>
                <div class="tw:flex tw:gap-10 tw:text-2xl">
                    <a href="<?php echo esc_url($data['brand']['whatsapp']); ?>" class="tw:text-white/60 hover:tw:text-orange-400 tw:transition-colors">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="mailto:<?php echo esc_attr($data['brand']['email']); ?>" class="tw:text-white/60 hover:tw:text-orange-400 tw:transition-colors">
                        <i class="bi bi-envelope"></i>
                    </a>
                </div>
            </div>
            <div class="tw:mt-16 tw:pt-10 tw:border-t tw:border-white/5 tw:text-center tw:text-white/40 tw:text-sm">
                &copy; <?php echo date('Y'); ?> DataMaq. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- MOBILE PARITY DOCK V6 -->
    <nav class="c-parity-dock lg:tw:hidden">
        <a href="#dm-main-header" class="c-parity-dock__link tw:flex-1 tw:flex tw:flex-col tw:items-center tw:gap-2 tw:text-white/70 hover:tw:text-orange-400">
            <i class="bi bi-house-door tw:text-2xl"></i>
            <span>INICIO</span>
        </a>
        <a href="#servicios" class="c-parity-dock__link tw:flex-1 tw:flex tw:flex-col tw:items-center tw:gap-2 tw:text-white/70 hover:tw:text-orange-400">
            <i class="bi bi-lightning-charge tw:text-2xl"></i>
            <span>SOLUCI&Oacute;N</span>
        </a>
        <a href="#faq" class="c-parity-dock__link tw:flex-1 tw:flex tw:flex-col tw:items-center tw:gap-2 tw:text-white/70 hover:tw:text-orange-400">
            <i class="bi bi-question-circle tw:text-2xl"></i>
            <span>FAQ</span>
        </a>
        <a href="#contacto" class="c-parity-dock__link tw:flex-1 tw:flex tw:flex-col tw:items-center tw:gap-2 tw:text-white/70 hover:tw:text-orange-400">
            <i class="bi bi-chat-dots tw:text-2xl"></i>
            <span>CONTACTO</span>
        </a>
    </nav>

    <!-- FABs -->
    <a href="https://wa.me/5491156297160" id="whatsapp-fab" class="tw:fixed tw:right-8 tw:bottom-8 tw:w-16 tw:h-16 tw:bg-[#25d366] tw:text-white tw:rounded-full tw:flex tw:items-center tw:justify-center tw:text-3xl tw:shadow-2xl tw:z-[9999] hover:tw:scale-110 tw:transition-all">
        <i class="bi bi-whatsapp"></i>
    </a>

    <?php wp_footer(); ?>
</body>
</html>
