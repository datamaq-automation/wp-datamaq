<?php
/**
 * The template for displaying the footer with Mobile Dock.
 */

$site_data = get_datamaq_site_data();
$brand = $site_data['brand'];
?>
    <footer class="c-home-footer tw:py-16 tw:bg-[#0c092f] tw:border-t tw:border-white/10 tw:text-white/60" role="contentinfo">
        <div class="tw:container tw:mx-auto tw:px-4">
            <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-3 tw:gap-12 tw:mb-16">
                <div>
                    <h3 class="tw:text-2xl tw:font-bold tw:text-white tw:mb-6"><?php echo esc_html($brand['name']); ?></h3>
                    <p class="tw:text-lg tw:leading-relaxed">Captura de datos industriales y capacitaci&oacute;n t&eacute;cnica aplicada para optimizar procesos energ&eacute;ticos y productivos.</p>
                </div>
                <div>
                    <h4 class="tw:font-bold tw:text-white tw:mb-6 tw:uppercase tw:tracking-widest tw:text-sm">Explorar</h4>
                    <ul class="tw:space-y-4 tw:text-lg">
                        <li><a href="<?php echo home_url('#servicios'); ?>" class="hover:tw:text-[#ff9a4d] tw:transition-colors">Soluci&oacute;n T&eacute;cnica</a></li>
                        <li><a href="<?php echo home_url('#faq'); ?>" class="hover:tw:text-[#ff9a4d] tw:transition-colors">Preguntas Frecuentes</a></li>
                        <li><a href="https://cursos.datamaq.com.ar" class="hover:tw:text-[#ff9a4d] tw:transition-colors">Plataforma de Cursos</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="tw:font-bold tw:text-white tw:mb-6 tw:uppercase tw:tracking-widest tw:text-sm">Contacto</h4>
                    <ul class="tw:space-y-4 tw:text-lg">
                        <li><?php echo esc_html($brand['base']); ?></li>
                        <li><a href="mailto:<?php echo esc_attr($brand['email']); ?>" class="hover:tw:text-[#ff9a4d] tw:transition-colors"><?php echo esc_html($brand['email']); ?></a></li>
                        <li><a href="<?php echo esc_url($brand['whatsapp']); ?>" class="hover:tw:text-[#ff9a4d] tw:transition-colors">WhatsApp Directo</a></li>
                    </ul>
                </div>
            </div>

            <div class="tw:pt-10 tw:border-t tw:border-white/5 tw:flex tw:flex-col md:tw:flex-row tw:justify-between tw:items-center tw:gap-6">
                <p class="tw:text-sm">(c) <?php echo date('Y'); ?> <?php echo esc_html($brand['name']); ?> | <?php echo esc_html($brand['base']); ?></p>
                <div class="tw:flex tw:gap-8 tw:text-sm">
                    <a href="#" class="hover:tw:text-white">Privacidad</a>
                    <a href="#" class="hover:tw:text-white">T&eacute;rminos</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Dock Navigation -->
    <nav class="c-parity-dock tw:lg:hidden" aria-label="Navegaci&oacute;n r&aacute;pida">
        <a href="<?php echo home_url('/'); ?>" class="c-parity-dock__link">
            <i class="bi bi-house-door-fill" aria-hidden="true"></i>
            <span>Inicio</span>
        </a>
        <a href="<?php echo home_url('#servicios'); ?>" class="c-parity-dock__link">
            <i class="bi bi-grid-1x2-fill" aria-hidden="true"></i>
            <span>Soluci&oacute;n</span>
        </a>
        <a href="<?php echo home_url('#faq'); ?>" class="c-parity-dock__link">
            <i class="bi bi-patch-question-fill" aria-hidden="true"></i>
            <span>FAQ</span>
        </a>
        <a href="<?php echo home_url('#contacto'); ?>" class="c-parity-dock__link c-parity-dock__link--emergency">
            <i class="bi bi-envelope-fill" aria-hidden="true"></i>
            <span>Contacto</span>
        </a>
    </nav>

    <!-- WhatsApp FAB (Floating Action Button) -->
    <a
        id="whatsapp-fab"
        class="c-dm-fab"
        href="<?php echo esc_url($brand['whatsapp']); ?>"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat con nosotros"
    >
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Scroll to Top Button (Hidden on Mobile via CSS) -->
    <button id="scroll-to-top" class="c-dm-fab" aria-label="Volver arriba">
        <i class="bi bi-arrow-up-short"></i>
    </button>

<?php wp_footer(); ?>

</body>
</html>
