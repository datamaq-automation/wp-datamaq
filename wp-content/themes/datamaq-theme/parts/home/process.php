<?php
/**
 * Partial: Home Process (Native-First)
 */
$repo = dm_content_repo();
$data = $repo->getAll();
$process = $data['process'] ?? array();
?>

<section id="proceso" class="section-mobile c-home-process" aria-labelledby="proceso-title" style="padding-block: 4rem;">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="c-home-section-head">
			<span class="c-home-eyebrow"><?php echo esc_html( $process['eyebrow'] ?? 'Cómo trabajamos' ); ?></span>
			<h2 id="proceso-title" class="c-home-section-title">
				<?php echo esc_html( $process['title'] ?? 'Flujo de implementación técnica' ); ?>
			</h2>
		</div>

		<div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2 tw:lg:grid-cols-4 tw:gap-6">
			<?php foreach ( $process['steps'] ?? array() as $step ) : ?>
				<article class="c-home-panel" style="padding: 1.5rem;">
					<span style="font-weight: 800; color: rgb(var(--dm-accent-orange-rgb)); font-size: 1.5rem; display: block; margin-bottom: 0.5rem;">
						<?php echo esc_html( $step['order'] ); ?>
					</span>
					<h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 0.75rem;">
						<?php echo esc_html( $step['title'] ); ?>
					</h3>
					<p style="font-size: 0.9rem; color: rgba(var(--dm-text-0-rgb), 0.7); line-height: 1.5;">
						<?php echo esc_html( $step['description'] ); ?>
					</p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
