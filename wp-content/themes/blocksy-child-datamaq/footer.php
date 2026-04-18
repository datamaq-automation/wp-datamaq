<?php
/**
 * The template for displaying the footer.
 *
 * @package Blocksy
 */

?>
    <footer class="tw:py-16 tw:bg-[#0c092f] tw:border-t tw:border-white/10 tw:text-white/60">
        <div class="tw:container tw:mx-auto tw:px-4">
            <div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-3 tw:gap-12 tw:mb-16">
                <div>
                    <h3 class="tw:text-2xl tw:font-bold tw:text-white tw:mb-6">DataMaq</h3>
                    <p class="tw:text-lg tw:leading-relaxed">Captura de datos industriales y capacitación técnica aplicada para optimizar procesos energéticos y productivos.</p>
                </div>
                <div>
                    <h4 class="tw:font-bold tw:text-white tw:mb-6 tw:uppercase tw:tracking-widest tw:text-sm">Explorar</h4>
                    <ul class="tw:space-y-4 tw:text-lg">
                        <li><a href="#servicios" class="hover:tw:text-[#ff9a4d] tw:transition-colors">Solución Técnica</a></li>
                        <li><a href="#proceso" class="hover:tw:text-[#ff9a4d] tw:transition-colors">Proceso de Trabajo</a></li>
                        <li><a href="#faq" class="hover:tw:text-[#ff9a4d] tw:transition-colors">Preguntas Frecuentes</a></li>
                        <li><a href="https://cursos.datamaq.com.ar" class="hover:tw:text-[#ff9a4d] tw:transition-colors">Plataforma de Cursos</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="tw:font-bold tw:text-white tw:mb-6 tw:uppercase tw:tracking-widest tw:text-sm">Contacto</h4>
                    <ul class="tw:space-y-4 tw:text-lg">
                        <li>Garín (GBA Norte)</li>
                        <li><a href="mailto:info@datamaq.com.ar" class="hover:tw:text-[#ff9a4d] tw:transition-colors">info@datamaq.com.ar</a></li>
                        <li><a href="https://wa.me/5491156297160?text=Hola%20DataMaq%2C%20necesito%20asistencia%20t%C3%A9cnica%20para%20%5BTipo%20de%20Maquina%5D." class="hover:tw:text-[#ff9a4d] tw:transition-colors">WhatsApp Directo</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="tw:pt-10 tw:border-t tw:border-white/5 tw:flex tw:flex-col md:tw:flex-row tw:justify-between tw:items-center tw:gap-6">
                <p class="tw:text-sm">(c) <?php echo date('Y'); ?> DataMaq | Garín (GBA Norte)</p>
                <div class="tw:flex tw:gap-8 tw:text-sm">
                    <a href="#" class="hover:tw:text-white">Privacidad</a>
                    <a href="#" class="hover:tw:text-white">Términos</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp FAB (Parity) -->
    <a 
        id="whatsapp-fab" 
        class="c-dm-fab" 
        href="https://wa.me/5491156297160" 
        target="_blank" 
        rel="noopener noreferrer" 
        aria-label="Abrir WhatsApp para pedir coordinación"
    >
        <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2a9.8 9.8 0 0 0-8.38 14.87L2 22l5.28-1.57A9.8 9.8 0 1 0 12 2Zm0 17.65a7.9 7.9 0 0 1-4.03-1.1l-.3-.18-3.14.94.97-3.06-.2-.31A7.9 7.9 0 1 1 12 19.65Zm4.34-5.91c-.24-.12-1.4-.7-1.62-.77-.22-.08-.38-.12-.54.12-.16.23-.62.77-.76.92-.14.15-.28.18-.52.06-.24-.12-1-.38-1.92-1.2a7.2 7.2 0 0 1-1.33-1.64c-.14-.23 0-.36.1-.48.11-.11.24-.28.36-.42.12-.14.16-.23.24-.38.08-.15.04-.29-.02-.41-.06-.12-.54-1.31-.74-1.79-.2-.48-.41-.41-.56-.42h-.48a.92.92 0 0 0-.66.31c-.22.24-.84.82-.84 2s.86 2.31.98 2.47c.12.16 1.69 2.57 4.09 3.6.57.25 1.01.4 1.36.51.57.18 1.08.16 1.49.1.46-.07 1.4-.57 1.6-1.12.2-.55.2-1.02.14-1.12-.06-.09-.22-.15-.46-.27Z"/>
        </svg>
    </a>

    <!-- Scroll to Top Button (FAB) -->
    <button id="scroll-to-top" class="c-dm-fab" aria-label="Volver arriba">
        <i class="bi bi-arrow-up-short"></i>
    </button>

<?php wp_footer(); ?>

</body>
</html>
