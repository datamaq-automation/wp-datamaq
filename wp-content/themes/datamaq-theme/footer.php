<?php
/**
 * Main Footer Template
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
                        <?php echo $data['legal']['text'] ?? 'La información publicada es referencial y puede actualizarse según alcance y condiciones de implementación.'; ?>
                    </p>
                </div>

                <!-- Right: CTA -->
                <div class="tw:text-center lg:tw:text-right">
                    <button onclick="window.$chatwoot ? window.$chatwoot.toggle() : window.location.href='#contacto'" class="tw:text-orange-400 tw:font-black tw:text-lg hover:tw:text-orange-300 tw:transition-colors tw:bg-transparent tw:border-none tw:cursor-pointer">
                        Hablemos ahora
                    </button>
                </div>
            </div>
        </div>
    </footer>

</div><!-- /.app-shell -->


</div><!-- /#app -->
    <?php wp_footer(); ?>
</body>
</html>
