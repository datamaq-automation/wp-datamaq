<?php
try {
    $viewModel = new \DataMaq\UI\ViewModels\FooterViewModel(dm_content_repo());
} catch (\Throwable $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo "<!-- Error in FooterViewModel: " . esc_html($e->getMessage()) . " -->";
    }
    $viewModel = null;
}
?>
<footer class="c-home-footer" role="contentinfo">
    <div class="tw:container tw:mx-auto tw:px-4">
        <div class="c-home-footer__shell">
            <div>
                <p class="c-home-footer__brand">DataMaq</p>
                <p class="c-home-footer__note"><?php echo $viewModel ? esc_html($viewModel->getCopyright()) : '(c) ' . date('Y') . ' DataMaq'; ?></p>
            </div>

            <p class="c-home-footer__legal">
                <?php echo $viewModel ? esc_html($viewModel->getLegalText()) : ''; ?>
            </p>
            
            <?php if ($viewModel) : ?>
                <a class="c-home-footer__whatsapp" href="<?php echo esc_url($viewModel->getWhatsAppUrl()); ?>" target="_blank" rel="noopener noreferrer">Escribime</a>
            <?php endif; ?>
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
