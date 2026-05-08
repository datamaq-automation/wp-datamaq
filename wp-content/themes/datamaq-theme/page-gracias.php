<?php
/**
 * Template Name: Success Page (V6 Absolute Parity)
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$data  = get_datamaq_site_data();
$brand = $data['brand'];

get_header();
?>

<div class="c-thanks-page-shell tw:min-h-screen tw:bg-[#0c092f] tw:flex tw:items-center tw:justify-center tw:text-white tw:relative tw:overflow-hidden">
	<!-- Ambient radial glow -->
	<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; height: 80%; background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%); pointer-events: none; z-index: 1;"></div>

	<main id="contenido-principal" class="tw:relative tw:z-[10] tw:max-w-2xl tw:w-full tw:px-6 tw:py-24 tw:text-center tw:flex tw:flex-col tw:items-center">
		
		<!-- Success Icon -->
		<div class="tw:mb-12 tw:relative tw:w-32 tw:h-32 tw:flex-shrink-0">
			<div style="position: absolute; inset: 0; background: #ff6a00; opacity: 0.2; filter: blur(30px); border-radius: 50%;"></div>
			<div class="tw:relative tw:w-full tw:h-full tw:bg-white/5 tw:border tw:border-white/10 tw:rounded-full tw:flex tw:items-center tw:justify-center tw:text-6xl tw:text-orange-500 tw:shadow-2xl tw:backdrop-blur-xl" style="aspect-ratio: 1/1;">
				<i class="bi bi-check-lg"></i>
			</div>
		</div>

		<p style="color: #ff6a00;" class="tw:font-black tw:uppercase tw:tracking-[0.2em] tw:text-xs tw:mb-6">&iexcl;Recibido!</p>
		<h1 class="tw:text-5xl md:tw:text-7xl tw:font-black tw:text-white tw:mb-8 tw:tracking-tighter tw:leading-tight">
			Consulta enviada
		</h1>
		<p class="tw:text-xl tw:text-white/60 tw:leading-relaxed tw:mb-12 tw:max-w-md tw:mx-auto">
			Gracias por contactarte. En breve un t&eacute;cnico especialista revisar&aacute; tu requerimiento para darte la mejor soluci&oacute;n.
		</p>

		<!-- Action Buttons -->
		<div class="tw:flex tw:flex-col sm:tw:flex-row tw:gap-4 tw:justify-center tw:w-full">
			<a href="<?php echo esc_url( $brand['whatsapp'] ); ?>" class="tw:btn tw:bg-orange-500 tw:text-[#0c092f] tw:font-black tw:py-4 tw:px-12 tw:rounded-xl tw:flex tw:items-center tw:justify-center tw:gap-3 hover:tw:bg-orange-400 tw:transition-all" style="background-color: #ff6a00 !important; color: #0c092f !important;">
				<i class="bi bi-whatsapp"></i>
				<span>Coordin&aacute; por WhatsApp</span>
			</a>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tw:btn tw:border tw:border-white/20 tw:text-white tw:py-4 tw:px-12 tw:rounded-xl tw:flex tw:items-center tw:justify-center hover:tw:bg-white/5 tw:transition-all">
				Volv&eacute; al inicio
			</a>
		</div>

	</main>

	<!-- Decorative background elements -->
	<div style="position: absolute; bottom: -10%; right: -5%; width: 400px; height: 400px; background: #4299e1; opacity: 0.05; filter: blur(100px); border-radius: 50%;"></div>
</div>

<?php get_footer(); ?>
