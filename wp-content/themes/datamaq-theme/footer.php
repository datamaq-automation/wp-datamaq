<?php
/**
 * Main Footer Template
 */
$viewModel = new \DataMaq\UI\ViewModels\FooterViewModel(dm_content_repo());
?>
    <footer class="c-home-footer tw:py-12 tw:bg-[#03041a] tw:border-t tw:border-white/5">
        <div class="tw:container tw:mx-auto tw:px-6">
            <div class="tw:flex tw:flex-col md:tw:flex-row tw:justify-between tw:items-center tw:gap-8">
                <div class="tw:flex tw:items-center tw:gap-3">
                    <span class="tw:font-black tw:tracking-tighter tw:text-2xl">DataMaq</span>
                </div>
                <div class="tw:text-sm /40">
                    <?php echo esc_html($viewModel->getCopyright()); ?>
                </div>
            </div>
        </div>
    </footer>

    <nav class="c-home-dock tw:lg:hidden c-home-dock--direct" aria-label="Navegación rápida" style="--dock-columns: 2;">
        <a aria-current="page" href="<?php echo esc_url($viewModel->getHomeUrl()); ?>" class="c-home-dock__link">
            <i class="bi bi-house-door-fill" aria-hidden="true"></i>
            <span>Inicio</span>
        </a>
        <a href="<?php echo esc_url($viewModel->getContactUrl()); ?>" class="c-home-dock__link c-home-dock__link--emergency">
            <i class="bi bi-telephone-forward-fill" aria-hidden="true"></i>
            <span>Contacto</span>
        </a>
    </nav>

</div><!-- /.app-shell -->
</div><!-- /#app -->
    <?php wp_footer(); ?>
</body>
</html>
