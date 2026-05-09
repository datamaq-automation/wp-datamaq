<?php
/**
 * Partial: Home Profile (Native-First)
 * @var \DataMaq\UI\ViewModels\HomeViewModel $vm
 */
$info = $vm->getProfileInfo();
?>

<section id="perfil" class="section-mobile c-home-profile" aria-labelledby="perfil-title">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="tw:grid tw:grid-cols-1 tw:lg:grid-cols-12 tw:gap-8 tw:items-stretch">
			<div class="tw:col-span-1 tw:lg:col-span-5">
				<article class="c-home-panel c-home-profile__card">
					<span class="c-home-eyebrow">Sobre DataMaq</span>
					<div class="c-home-profile__avatar-wrap">
						<img src="<?php echo esc_url( $info['photo'] ); ?>"
						     alt="<?php echo esc_attr( $info['name'] ); ?>"
						     class="c-home-profile__avatar"
						     width="300"
						     height="300"
						     loading="lazy"
						     decoding="async">
					</div>
					<h2 id="perfil-title" class="c-home-profile__name"><?php echo esc_html( $info['name'] ); ?></h2>
					<p class="c-home-profile__role"><?php echo esc_html( $info['role'] ); ?></p>
					<p class="c-home-profile__lead">
						<?php echo esc_html( $info['lead'] ); ?>
					</p>
					<a href="https://wa.me/5491156297160" class="tw:btn-primary c-home-profile__cta">
						Conversá con nuestro Agente
					</a>
				</article>
			</div>

			<div class="tw:col-span-1 tw:lg:col-span-7">
				<article class="c-home-panel c-home-profile__details">
					<p class="c-home-profile__section-label">
						<?php echo $vm->isAuthority() ? 'Por qué elegirnos' : 'Enfoque técnico'; ?>
					</p>
					<p class="c-home-profile__detail-copy">
						<?php echo esc_html( $info['detail'] ); ?>
					</p>
					
					<ul class="c-home-profile__bullets">
						<?php foreach ( $info['bullets'] as $bullet ) : ?>
							<li style="display: flex; gap: 0.75rem; margin-top: 1rem;">
								<span class="c-home-profile__bullet-dot" style="flex: 0 0 auto; width: 0.55rem; height: 0.55rem; margin-top: 0.45rem; border-radius: 999px; background: rgb(var(--dm-accent-orange-rgb));"></span>
								<span><?php echo esc_html( $bullet ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</article>
			</div>
		</div>
	</div>
</section>
