<?php
/**
 * Partial: Home Services (Native-First)
 * @var \DataMaq\UI\ViewModels\HomeViewModel $vm
 */
$repo     = dm_content_repo();
$services = $repo->getServicesSection();
?>

<section id="servicios" class="section-mobile c-home-services" aria-labelledby="servicios-title">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="c-home-section-head">
			<span class="c-home-eyebrow"><?php echo esc_html( $services->getEyebrow() ); ?></span>
			<h2 id="servicios-title" class="c-home-section-title">
				<?php echo esc_html( $services->getTitle() ); ?>
			</h2>
			<p class="c-home-section-copy">
				<?php echo esc_html( $services->getIntro() ); ?>
			</p>
		</div>

		<div class="c-home-services__grid">
			<?php foreach ( $services->getServices() as $card ) : ?>
				<article class="c-home-service-card">
					<div class="c-home-service-card__summary">
						<span class="c-home-service-card__icon" aria-hidden="true">
							<i class="bi <?php echo esc_attr( $vm->getServiceIcon( $card->getTitle(), $card->getTitle() ) ); ?>"></i>
						</span>
						<span class="c-home-service-card__summary-copy">
							<span class="c-home-service-card__title" style="display: block; font-weight: 800; font-size: 1.25rem; margin-bottom: 0.5rem;">
								<?php echo esc_html( $card->getTitle() ); ?>
							</span>
							<span class="c-home-service-card__description" style="color: rgba(var(--dm-text-0-rgb), 0.7);">
								<?php echo esc_html( $card->getDescription() ); ?>
							</span>
						</span>
					</div>

					<div class="c-home-service-card__content" style="margin-top: 1.5rem;">
						<p class="c-home-service-card__subtitle" style="font-weight: 700; color: rgb(var(--dm-accent-orange-rgb)); font-size: 0.85rem; text-transform: uppercase; margin-bottom: 1rem;">
							<?php echo esc_html( $card->getSubtitle() ); ?>
						</p>
						<ul class="c-home-service-card__list" style="list-style: none; padding: 0; margin: 0 0 1.5rem;">
							<?php foreach ( array_slice( $card->getItems(), 0, 3 ) as $item ) : ?>
								<li style="display: flex; gap: 0.75rem; margin-bottom: 0.5rem; align-items: flex-start;">
									<i class="bi bi-check2-circle" style="color: rgb(var(--dm-accent-orange-rgb));"></i>
									<span style="font-size: 0.95rem;"><?php echo esc_html( $item ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<a href="#contacto" class="tw:btn-outline c-home-service-card__cta" style="width: 100%; display: inline-flex; justify-content: center; padding: 0.75rem;">
							<?php echo esc_html( $card->getCtaLabel() ); ?>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
