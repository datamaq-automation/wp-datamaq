<?php
namespace Datamaq\Costs\Infrastructure\UI\Frontend;

use Datamaq\Costs\Domain\Repository\SettingsRepositoryInterface;

class ShortcodeHandler {
    private SettingsRepositoryInterface $settingsRepository;

    public function __construct(SettingsRepositoryInterface $settingsRepository) {
        $this->settingsRepository = $settingsRepository;
    }

    public function init(): void {
        add_shortcode('datamaq_presupuesto_relevamiento', [$this, 'render']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function render($atts): string {
        // En un entorno DDD ideal, esto cargaría un template
        ob_start();
        include plugin_dir_path(__FILE__) . '../../../../templates/frontend/calculator.php';
        return ob_get_clean();
    }

    public function enqueue_assets(): void {
        if (!is_product() || get_the_ID() !== 251) {
            return;
        }

        $settings = $this->settingsRepository->getSettings();
        $apiKey = $settings->getGoogleApiKey()->getValue();

        if (empty($apiKey)) {
            return;
        }

        // Google Maps API con Places Library
        wp_enqueue_script(
            'google-maps-places',
            "https://maps.googleapis.com/maps/api/js?key={$apiKey}&libraries=places",
            [],
            null,
            true
        );

        wp_enqueue_style(
            'datamaq-calculator-css',
            plugins_url('assets/css/calculator.css', DATAMAQ_COSTS_FILE),
            [],
            '1.0.0'
        );

        wp_enqueue_script(
            'datamaq-calculator-js',
            plugins_url('assets/js/calculator.js', DATAMAQ_COSTS_FILE),
            ['jquery', 'google-maps-places'],
            '1.0.0',
            true
        );

        wp_localize_script('datamaq-calculator-js', 'datamaq_costs', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('datamaq_costs_nonce'),
            'product_id' => 251
        ]);
    }
}
