<?php
/**
 * Main Footer Template
 */
$data = get_datamaq_site_data();
?>
    <nav class="c-home-dock tw:lg:hidden c-home-dock--direct" aria-label="Navegación rápida" style="--dock-columns: 2;">
        <a aria-current="page" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-home-dock__link">
            <i class="bi bi-house-door-fill" aria-hidden="true"></i>
            <span>Inicio</span>
        </a>
        <a href="http://legacy.localhost/contact" class="c-home-dock__link c-home-dock__link--emergency">
            <i class="bi bi-telephone-forward-fill" aria-hidden="true"></i>
            <span>Contacto</span>
        </a>
    </nav>

</div><!-- /.app-shell -->


</div><!-- /#app -->
    <?php wp_footer(); ?>
</body>
</html>
