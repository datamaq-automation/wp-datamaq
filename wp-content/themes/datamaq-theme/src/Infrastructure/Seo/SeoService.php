<?php
namespace DataMaq\Infrastructure\Seo;

class SeoService {
	public function registerHooks() {
		add_action( 'wp_head', array( $this, 'injectMetaTags' ), 1 );
		add_action( 'wp_head', array( $this, 'injectJsonLd' ), 20 );
	}

	public function injectMetaTags() {
		$description = 'Lideramos la captura automática de datos operativos para energía y producción mediante integración de equipos IoT.';
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
		echo '<meta property="og:type" content="website">' . "\n";
		echo '<meta property="og:site_name" content="DataMaq">' . "\n";
	}

	public function injectJsonLd() {
		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'LocalBusiness',
			'name'     => 'DataMaq',
			'image'    => get_template_directory_uri() . '/assets/media/hero-energy.svg',
			'email'    => 'info@datamaq.com.ar',
			'url'      => home_url( '/' ),
			'address'  => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => 'Buenos Aires',
				'addressCountry'  => 'AR',
			),
		);
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
	}
}
