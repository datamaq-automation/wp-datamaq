<?php
namespace Datamaq\Costs\Infrastructure\UI\Frontend;

use Datamaq\Costs\Domain\Repository\SettingsRepositoryInterface;
use Datamaq\Costs\Domain\Services\ContextServiceInterface;

class ShortcodeHandler {
    private SettingsRepositoryInterface $settingsRepository;
    private ContextServiceInterface $contextService;

    public function __construct(
        SettingsRepositoryInterface $settingsRepository,
        ContextServiceInterface $contextService
    ) {
        $this->settingsRepository = $settingsRepository;
        $this->contextService = $contextService;
    }

    public function init(): void {
        add_action('init', function() {
            add_shortcode('datamaq_presupuesto_relevamiento', [$this, 'render']);
        });
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        
        // Inyectar en el footer de forma oculta para que JS la mueva al lugar correcto en el App de Vue
        add_action('wp_footer', [$this, 'inject_hidden_calculator']);
    }

    public function inject_hidden_calculator(): void {
        echo '<!-- [DataMaq Debug] Inyectando calculadora oculta -->';
        echo '<div id="dm-calculator-transport" style="display:none;">';
        echo do_shortcode('[datamaq_presupuesto_relevamiento]');
        echo '</div>';
    }

    public function render($atts): string {
        $templatePath = plugin_dir_path(__FILE__) . '../../../../templates/frontend/calculator.php';
        
        if (!file_exists($templatePath)) {
            return "";
        }

        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

    public function enqueue_assets(): void {
        if (!$this->contextService->isProductPage(251)) {
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
            "https://maps.googleapis.com/maps/api/js?key={$apiKey}&libraries=places&loading=async&callback=Function.prototype",
            [],
            null,
            true
        );

        wp_enqueue_style(
            'datamaq-calculator-css',
            plugins_url('assets/css/calculator.css', DATAMAQ_COSTS_FILE),
            [],
            '1.0.4'
        );

        wp_enqueue_script(
            'datamaq-calculator-js',
            plugins_url('assets/js/calculator.js', DATAMAQ_COSTS_FILE),
            ['jquery', 'google-maps-places'],
            '1.0.4',
            true
        );

        wp_localize_script('datamaq-calculator-js', 'datamaq_costs', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('datamaq_costs_nonce'),
            'product_id' => 251
        ]);
    }
}
