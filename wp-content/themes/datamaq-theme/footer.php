<?php
try {
	$view_model = new \DataMaq\UI\ViewModels\FooterViewModel( dm_content_repo() );
} catch ( \Throwable $e ) {
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		echo '<!-- Error in FooterViewModel: ' . esc_html( $e->getMessage() ) . ' -->';
	}
	$view_model = null;
}
?>
<footer class="c-home-footer" role="contentinfo">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="c-home-footer__main tw:grid tw:grid-cols-1 tw:md:grid-cols-3 tw:lg:grid-cols-4 tw:gap-12 tw:py-16">
			<!-- Columna 1: Marca -->
			<div class="c-home-footer__brand-col">
				<p class="c-home-footer__brand">DataMaq</p>
				<p class="c-home-footer__description tw:text-dm-text-400 tw:text-sm tw:leading-relaxed">
					Soluciones integrales de automatización industrial, control de procesos y captura de datos para la industria moderna.
				</p>
				<p class="c-home-footer__location tw:mt-4 tw:text-xs tw:uppercase tw:tracking-widest tw:text-dm-text-600">
					<i class="bi bi-geo-alt-fill tw:mr-1"></i> Garín (GBA Norte)
				</p>
			</div>

			<!-- Columna 2: Explorar -->
			<div class="c-home-footer__nav-col">
				<p class="c-home-footer__title tw:text-white tw:font-bold tw:mb-6">Explorar</p>
				<nav class="tw:flex tw:flex-col tw:gap-4">
					<a href="<?php echo esc_url( $view_model->getHomeUrl() ); ?>" class="c-home-footer__link">Inicio</a>
					<a href="<?php echo esc_url( $view_model->getProductsUrl() ); ?>" class="c-home-footer__link">Productos</a>
					<a href="<?php echo esc_url( $view_model->getTrainingUrl() ); ?>" class="c-home-footer__link">Capacitaciones</a>
				</nav>
			</div>

			<!-- Columna 3: Servicios -->
			<div class="c-home-footer__services-col">
				<p class="c-home-footer__title tw:text-white tw:font-bold tw:mb-6">Servicio</p>
				<nav class="tw:flex tw:flex-col tw:gap-4">
					<a href="<?php echo esc_url( $view_model->getContactUrl() ); ?>" class="c-home-footer__link">Contacto</a>
					<?php 
					$chatwoot = dm_chat_manager()->getProvider('chatwoot');
					if ( $chatwoot && $chatwoot->isEnabled() ) : ?>
						<a href="#chat" class="c-home-footer__link">Consultar Asistente</a>
					<?php else : ?>
						<a href="<?php echo esc_url( $view_model->getWhatsAppUrl() ); ?>" class="c-home-footer__link">Soporte Técnico</a>
					<?php endif; ?>
				</nav>
			</div>
 
			<!-- Columna 4: Acción -->
			<div class="c-home-footer__cta-col tw:flex tw:flex-col tw:items-start tw:lg:items-end">
				<?php if ( $view_model ) : ?>
					<?php 
					$chatwoot = dm_chat_manager()->getProvider('chatwoot');
					if ( $chatwoot && $chatwoot->isEnabled() ) : ?>
						<a class="tw:btn-primary c-ui-btn tw:w-full tw:lg:w-auto" href="#chat">
							<i class="bi bi-chat-dots-fill tw:mr-2"></i> Hablar con Asistente
						</a>
					<?php else : ?>
						<a class="tw:btn-primary c-ui-btn tw:w-full tw:lg:w-auto" href="<?php echo esc_url( $view_model->getWhatsAppUrl() ); ?>" target="_blank" rel="noopener noreferrer">
							<i class="bi bi-whatsapp tw:mr-2"></i> Escribinos
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>

		<!-- Barra Inferior: Legal -->
		<div class="c-home-footer__bottom tw:border-t tw:border-white/10 tw:py-8 tw:flex tw:flex-col tw:lg:flex-row tw:justify-between tw:items-center tw:gap-6">
			<p class="c-home-footer__note tw:text-xs tw:text-dm-text-600">
				<?php echo $view_model ? esc_html( $view_model->getCopyright() ) : '(c) ' . esc_html( gmdate( 'Y' ) ) . ' DataMaq'; ?>
			</p>
			<p class="c-home-footer__legal tw:max-w-2xl tw:text-center tw:lg:text-right">
				<?php echo $view_model ? esc_html( $view_model->getLegalText() ) : ''; ?>
			</p>
		</div>
	</div>
</footer>

<nav class="c-home-dock tw:lg:hidden c-home-dock--direct" aria-label="Navegación rápida" style="--dock-columns: 3;">
	<a <?php echo is_front_page() ? 'aria-current="page"' : ''; ?> href="<?php echo $view_model ? esc_url( $view_model->getHomeUrl() ) : '/'; ?>" class="c-home-dock__link">
		<i class="bi bi-house-door-fill" aria-hidden="true"></i>
		<span>Inicio</span>
	</a>
	<?php 
	$chatwoot = dm_chat_manager()->getProvider('chatwoot');
	if ( $chatwoot && $chatwoot->isEnabled() ) : ?>
		<a href="#chat" class="c-home-dock__link" id="dm-dock-chat">
			<i class="bi bi-chat-dots-fill" aria-hidden="true"></i>
			<span>Asistente</span>
		</a>
	<?php else : ?>
		<a href="<?php echo $view_model ? esc_url( $view_model->getWhatsAppUrl() ) : '#'; ?>" class="c-home-dock__link" target="_blank">
			<i class="bi bi-whatsapp" aria-hidden="true"></i>
			<span>WhatsApp</span>
		</a>
	<?php endif; ?>
	<a href="<?php echo $view_model ? esc_url( $view_model->getContactUrl() ) : '/contacto'; ?>" class="c-home-dock__link c-home-dock__link--emergency">
		<i class="bi bi-telephone-forward-fill" aria-hidden="true"></i>
		<span>Contacto</span>
	</a>
</nav>

<div class="tw:h-20 tw:lg:hidden"></div> <!-- Espaciador para que el dock no tape contenido -->
</div><!-- /.app-shell -->
</div><!-- /#app -->
	<?php wp_footer(); ?>
	<script>
		// Interceptar clics en enlaces #chat para abrir Chatwoot
		document.addEventListener('click', function(e) {
			if (e.target.closest('a[href="#chat"]')) {
				e.preventDefault();
				if (window.$chatwoot) {
					window.$chatwoot.toggle();
				}
			}
		});
	</script>
</body>
</html>
