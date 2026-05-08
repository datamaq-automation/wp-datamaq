<?php
/**
 * Template part for displaying services section.
 */
try {
	$view_model = new \DataMaq\UI\ViewModels\ServicesViewModel( dm_content_repo() );
} catch ( \Throwable $e ) {
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		echo '<!-- Error in ServicesViewModel: ' . esc_html( $e->getMessage() ) . ' -->';
	}
	return;
}
?>
<section id="servicios" data-dm-component="ScrollReveal" class="section-mobile c-home-services" aria-labelledby="servicios-title">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="c-home-section-head">
			<span class="c-home-eyebrow"><?php echo esc_html( $view_model->getEyebrow() ); ?></span>
			<h2 id="servicios-title" class="c-home-section-title"><?php echo esc_html( $view_model->getTitle() ); ?></h2>
			<p class="c-home-section-copy"><?php echo esc_html( $view_model->getIntro() ); ?></p>
		</div>

		<div class="c-home-services__grid">
			<?php foreach ( $view_model->getServices() as $service ) : ?>
				<article class="c-home-service-card">
					<div class="c-home-service-card__summary">
						<span class="c-home-service-card__icon" aria-hidden="true">
							<i class="bi <?php echo esc_attr( $service->getIconClass() ); ?>"></i>
						</span>
						<span class="c-home-service-card__summary-copy">
							<span class="c-home-service-card__title"><?php echo esc_html( $service->getTitle() ); ?></span>
							<span class="c-home-service-card__description"><?php echo esc_html( $service->getDescription() ); ?></span>
						</span>
					</div>
					<div class="c-home-service-card__content">
						<p class="c-home-service-card__subtitle"><?php echo esc_html( $service->getSubtitle() ); ?></p>
						<ul class="c-home-service-card__list">
							<?php foreach ( $service->getItems() as $item ) : ?>
								<li>
									<span class="c-home-service-card__bullet" aria-hidden="true">
										<i class="bi bi-check2-circle"></i>
									</span>
									<span><?php echo esc_html( $item ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<p class="c-home-service-card__note"><?php echo esc_html( $service->getNote() ); ?></p>
						<button type="button" class="tw:btn-outline c-home-service-card__cta"><?php echo esc_html( $service->getCtaLabel() ); ?></button>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

