<?php
/**
 * Template part for displaying the process section.
 */
$view_model = new \DataMaq\UI\ViewModels\ProcessViewModel( dm_content_repo() );
?>
<section id="proceso" data-dm-component="ScrollReveal" class="c-home-process section-mobile tw:bg-[#0c092f] tw:relative tw:overflow-hidden">
	<!-- Subtle ambient glow -->
	<div class="c-ambient-glow tw:bg-[#ff6a00] tw:top-[-20%] tw:right-[-10%] tw:opacity-[0.05]"></div>

	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="tw:max-w-5xl tw:mb-20">
			<span class="dm-eyebrow">
				<?php echo esc_html( $view_model->getEyebrow() ); ?>
			</span>
			<h2 class="tw:text-6xl lg:tw:text-8xl tw:font-black tw:mb-10 tw:tracking-tighter">
				<?php echo esc_html( $view_model->getTitle() ); ?>
			</h2>
		</div>

		<div class="tw:grid tw:grid-cols-1 md:tw:grid-cols-4 tw:gap-14">
			<?php foreach ( $view_model->getSteps() as $step ) : ?>
			<article class="c-home-process__step tw:group tw:relative">
				<!-- Parity Fix: Ultra-subtle background numbers -->
				<span class="tw:text-8xl tw:font-black /[0.04] tw:mb-6 tw:block tw:transition-colors group-hover:tw:text-[#ff9a4d]/10 tw:tracking-tighter">
					<?php echo esc_html( $step['order'] ); ?>
				</span>
				<h3 class="tw:text-3xl tw:font-bold tw:mb-6 tw:tracking-tight"><?php echo esc_html( $step['title'] ); ?></h3>
				<p class="/60 tw:text-xl tw:leading-relaxed"><?php echo esc_html( $step['description'] ); ?></p>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

