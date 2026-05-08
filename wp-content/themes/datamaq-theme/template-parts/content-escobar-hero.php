<?php
/**
 * Template part for displaying the Escobar Landing Hero section
 */
$data = dm_content_repo()->getSection( 'escobarLanding' );
?>
<section data-dm-component="ScrollReveal" class=" lg: tw:bg-[#0c092f]" aria-labelledby="escobar-hero-title">
	<div class="tw:container tw:mx-auto tw:px-4">
		<div class="tw:max-w-4xl">
			<p class="tw:uppercase tw:text-sm tw:font-black tw:text-[#ff9a4d] tw:mb-4 tw:tracking-widest">
				<?php echo esc_html( $data['eyebrow'] ); ?>
			</p>
			<h1 id="escobar-hero-title" class="tw:text-5xl lg:tw:text-7xl tw:font-black  tw:mb-8 tw:tracking-tighter tw:leading-[0.9]">
				<?php echo esc_html( $data['headline'] ); ?>
			</h1>
			<p class="tw:text-2xl /70 tw:mb-12 tw:leading-tight tw:font-medium">
				<?php echo esc_html( $data['lead'] ); ?>
			</p>
			
			<div class="tw:flex tw:flex-col sm:tw:flex-row tw:gap-6">
				<a href="https://wa.me/5491156297160" class="tw:btn-primary tw:px-12  tw:text-xl tw:font-black tw:text-center">
					Conversá con nuestro Agente
				</a>
				<a class="tw:btn-outline tw:px-12  tw:text-xl tw:text-center" href="#contacto">
					Consultá por el formulario
				</a>
			</div>
		</div>
	</div>
</section>
