<?php
/**
 * Partial: Home Hero (Native-First)
 * @var \DataMaq\UI\ViewModels\HomeViewModel $vm
 */
$repo = dm_content_repo();
$hero = $repo->getHeroSection();
$variant_class = $vm->isDirect() ? 'c-home-hero--direct' : 'c-home-hero--authority';
$image_url = $hero->getImagePath();
?>

<section class="section-mobile c-home-hero <?php echo esc_attr( $variant_class ); ?>"
         aria-labelledby="hero-title"
         style="background-image: linear-gradient(180deg, rgba(var(--dm-surface-0-rgb), 0.42), rgba(var(--dm-bg-0-rgb), 0.96)), url('<?php echo esc_url( $image_url ); ?>')">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="tw:grid tw:grid-cols-1 tw:lg:grid-cols-12 tw:gap-8 tw:items-end">
			<div class="tw:col-span-1 tw:lg:col-span-7">
				<div class="c-home-hero__copy">
					<span class="c-home-eyebrow"><?php echo esc_html( $hero->getEyebrow() ); ?></span>
					<h1 id="hero-title" class="c-home-hero__title">
						<?php echo esc_html( $hero->getTitle() ); ?>
					</h1>
					<p class="c-home-hero__subtitle">
						<?php echo esc_html( $hero->getSubtitle() ); ?>
					</p>

					<div class="c-home-hero__actions">
						<a href="https://wa.me/5491156297160" class="tw:btn-primary c-home-hero__primary">
							<?php echo esc_html( $hero->getCtaLabel() ); ?>
						</a>
						<?php if ( ! $vm->isDirect() ) : ?>
							<a href="#servicios" class="tw:btn-outline c-home-hero__secondary">
								Ver alcance técnico
							</a>
						<?php endif; ?>
					</div>

					<!-- Trust Signals (Derived from ViewModel) -->
					<div class="c-home-hero__trust-inline" aria-label="Capacidades destacadas">
						<?php foreach ( $vm->getTrustSignals() as $signal ) : ?>
							<span class="c-home-hero__trust-chip"><?php echo esc_html( $signal ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<div class="tw:col-span-1 tw:lg:col-span-5 <?php echo $vm->isDirect() ? 'tw:hidden tw:lg:block' : ''; ?>">
				<article class="c-home-hero__media-card">
					<p class="c-home-hero__media-label">Cobertura técnica activa</p>
					<img src="<?php echo esc_url( $image_url ); ?>"
					     alt="Captura e integración de datos"
					     class="c-home-hero__image"
					     width="900"
					     height="700"
					     fetchpriority="high"
					     loading="eager"
					     decoding="async">
				</article>
			</div>
		</div>
	</div>
</section>
