<?php
namespace DataMaq\Infrastructure\Seo;

class SeoService {
    public function registerHooks() {
        add_action('wp_head', [$this, 'injectMetaTags'], 1);
        add_action('wp_head', [$this, 'injectJsonLd'], 20);
    }

    public function injectMetaTags() {
        $description = 'Lideramos la captura automática de datos operativos para energía y producción mediante integración de equipos IoT.';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:site_name" content="DataMaq">' . "\n";
    }

    public function injectJsonLd() {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'DataMaq',
            'image' => get_template_directory_uri() . '/assets/media/hero-energy.svg',
            'email' => 'info@datamaq.com.ar',
            'url' => home_url('/'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Buenos Aires',
                'addressCountry' => 'AR'
            ]
        ];
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}
