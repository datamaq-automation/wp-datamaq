<?php
/**
 * Template Name: Gracias (Soberanía del Código)
 * Description: Vista de agradecimiento nativa con paridad 1:1 con la App de legado.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Dependencias de dominio e infraestructura
$repo = dm_content_repo();
$footer_vm = new \DataMaq\UI\ViewModels\FooterViewModel( $repo );
$theme_uri = get_template_directory_uri();

// Contenido con paridad de legado (Defaults del ThanksView.ts)
$thanks_content = [
	'badge'                => '¡Gracias!',
	'topbarTitle'          => 'Mensaje enviado',
	'title'                => '¡Listo! Recibimos tu mensaje',
	'subtitle'             => 'Te vamos a contactar a la brevedad',
	'whatsappButtonLabel'  => 'Escribime por WhatsApp',
	'goHomeButtonLabel'    => 'Volvé al inicio',
	'closeButtonAriaLabel' => 'Cerrá y volvé al inicio',
];

// Reemplazar con contenido dinámico si existe en el repositorio
// (Nota: Esto asume que el repositorio de contenido tiene una sección 'thanks')
$site_content = $repo->getHomeSection(); // Ejemplo, ajustar según el repo real
// if (isset($site_content['thanks'])) { ... }

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<title><?php echo esc_html( $thanks_content['title'] ); ?> | <?php bloginfo( 'name' ); ?></title>
	
	<?php wp_head(); ?>
	
	<link rel="stylesheet" href="<?php echo esc_url( $theme_uri ); ?>/assets/css/ThanksView.css">
</head>
<body <?php body_class( 'is-thanks-page' ); ?>>

<div class="thanks-shell">
	<a class="skip-link tw:sr-only" href="#contenido-principal">
		Saltar al contenido principal
	</a>
	
	<main id="contenido-principal" class="thanks-stage" aria-labelledby="thanks-title">
		<header class="thanks-topbar">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
			   class="thanks-topbar__close" 
			   aria-label="<?php echo esc_attr( $thanks_content['closeButtonAriaLabel'] ); ?>">
				<i class="bi bi-x-lg" aria-hidden="true"></i>
			</a>
			<h2 class="thanks-topbar__title"><?php echo esc_html( $thanks_content['topbarTitle'] ); ?></h2>
		</header>

		<section class="thanks-main">
			<div class="thanks-main__icon-wrap" aria-hidden="true">
				<div class="thanks-main__icon-glow"></div>
				<div class="thanks-main__icon">
					<i class="bi bi-check-lg"></i>
				</div>
			</div>
			
			<p class="thanks-main__badge"><?php echo esc_html( $thanks_content['badge'] ); ?></p>
			<h1 id="thanks-title" class="thanks-main__title"><?php echo esc_html( $thanks_content['title'] ); ?></h1>
			<p class="thanks-main__copy"><?php echo esc_html( $thanks_content['subtitle'] ); ?></p>
		</section>

		<footer class="thanks-actions">
			<a href="<?php echo esc_url( $footer_vm->getWhatsAppUrl() ); ?>" class="thanks-actions__whatsapp">
				<i class="bi bi-whatsapp" aria-hidden="true"></i>
				<span><?php echo esc_html( $thanks_content['whatsappButtonLabel'] ); ?></span>
			</a>
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="thanks-actions__home">
				<?php echo esc_html( $thanks_content['goHomeButtonLabel'] ); ?>
			</a>
		</footer>

		<div class="thanks-stage__glow" aria-hidden="true"></div>
	</main>
</div>

<?php get_template_part( 'parts/whatsapp-fab' ); ?>

<?php wp_footer(); ?>

<script>
/**
 * Lead Tracking Parity
 * Emula el comportamiento de leadTracking.trackGenerateLeadOnce()
 */
(function() {
	if (window.datamaq_tracker) {
		window.datamaq_tracker.trackGenerateLeadOnce({
			page_location: window.location.href
		});
	} else {
		console.log('[ThanksView] Tracker not found, tracking skipped.');
	}
})();
</script>

</body>
</html>
