<?php
/**
 * Partial: Home FAQ (Native-First)
 */
$repo = dm_content_repo();
$faq = $repo->getFaqSection();
?>

<section id="faq" class="section-mobile c-home-faq" aria-labelledby="faq-title" style="padding-block: 4rem;">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="c-home-section-head">
			<span class="c-home-eyebrow"><?php echo esc_html( $faq->getEyebrow() ); ?></span>
			<h2 id="faq-title" class="c-home-section-title"><?php echo esc_html( $faq->getTitle() ); ?></h2>
		</div>

		<div class="c-home-faq__list" style="max-width: 800px; margin: 0 auto;">
			<?php foreach ( $faq->getItems() as $idx => $item ) : ?>
				<details class="c-home-panel" style="margin-bottom: 1rem; padding: 0;" <?php echo $idx === 0 ? 'open' : ''; ?>>
					<summary style="padding: 1.25rem; font-weight: 700; cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center;">
						<?php echo esc_html( $item->getQuestion() ); ?>
						<i class="bi bi-chevron-down"></i>
					</summary>
					<div style="padding: 0 1.25rem 1.25rem; color: rgba(var(--dm-text-0-rgb), 0.8); line-height: 1.6;">
						<?php echo wp_kses_post( $item->getAnswer() ); ?>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<style>
.c-home-faq__list details summary::-webkit-details-marker {
	display: none;
}
.c-home-faq__list details[open] summary i {
	transform: rotate(180deg);
}
.c-home-faq__list details summary i {
	transition: transform 0.2s ease;
}
</style>
