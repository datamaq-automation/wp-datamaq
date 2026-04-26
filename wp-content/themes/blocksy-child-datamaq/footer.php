<?php
/**
 * Template part for displaying the footer with V6 Absolute Parity + App Shell.
 */
$data = get_datamaq_site_data();
?>
    <footer class="c-home-footer tw:bg-[#0c092f] tw:py-20 tw:border-t tw:border-white/5">
        <div class="tw:container tw:mx-auto tw:px-6">
            <div class="c-home-footer__shell tw:flex tw:flex-col lg:tw:flex-row tw:justify-between tw:items-center tw:gap-12">
                <!-- Left: Brand & Note -->
                <div class="tw:text-center lg:tw:text-left">
                    <p class="tw:text-2xl tw:font-black tw:text-white tw:mb-1"><?php echo $data['brand']['name']; ?></p>
                    <p class="tw:text-white/40 tw:text-sm">
                        &copy; <?php echo date('Y'); ?> <?php echo $data['brand']['base']; ?>
                    </p>
                </div>

                <!-- Center: Legal -->
                <div class="lg:tw:max-w-xl tw:text-center">
                    <p class="tw:text-white/30 tw:text-[11px] tw:leading-relaxed tw:uppercase tw:tracking-widest">
                        <?php echo $data['legal']['text']; ?>
                    </p>
                </div>

                <!-- Right: CTA -->
                <div class="tw:text-center lg:tw:text-right">
                    <button onclick="window.$chatwoot.toggle()" class="tw:text-orange-400 tw:font-black tw:text-lg hover:tw:text-orange-300 tw:transition-colors tw:bg-transparent tw:border-none tw:cursor-pointer">
                        Hablemos ahora
                    </button>
                </div>
            </div>
        </div>
    </footer>

<?php if ( is_front_page() ) : ?>
</div><!-- /.dm-app-shell -->
<?php endif; ?>

    <!-- MOBILE PARITY DOCK V6 -->
    <nav class="c-home-dock lg:tw:hidden tw:fixed tw:bottom-0 tw:left-0 tw:right-0 tw:bg-[#0c092f]/95 tw:backdrop-blur-xl tw:border-t tw:border-white/10 tw:z-[5000] tw:flex tw:justify-around tw:py-4">
        <a href="#top" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/40 hover:tw:text-orange-400 tw:transition-colors">
            <i class="bi bi-house tw:text-xl"></i>
            <span class="tw:text-[11px] tw:font-black tw:uppercase tw:tracking-tighter">Inicio</span>
        </a>
        <a href="#servicios" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/40 hover:tw:text-orange-400 tw:transition-colors">
            <i class="bi bi-cpu tw:text-xl"></i>
            <span class="tw:text-[11px] tw:font-black tw:uppercase tw:tracking-tighter">Soluci&oacute;n</span>
        </a>
        <a href="#perfil" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/40 hover:tw:text-orange-400 tw:transition-colors">
            <i class="bi bi-person-badge tw:text-xl"></i>
            <span class="tw:text-[11px] tw:font-black tw:uppercase tw:tracking-tighter">Perfil</span>
        </a>
        <a onclick="window.$chatwoot.toggle()" class="c-home-dock__link tw:flex tw:flex-col tw:items-center tw:gap-1 tw:text-white/40 hover:tw:text-orange-400 tw:transition-colors tw:cursor-pointer">
            <i class="bi bi-chat-right-text tw:text-xl"></i>
            <span class="tw:text-[11px] tw:font-black tw:uppercase tw:tracking-tighter">Chat</span>
        </a>
    </nav>

    <?php wp_footer(); ?>
</body>
</html>
