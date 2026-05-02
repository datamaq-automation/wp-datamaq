<?php
namespace Datamaq\Costs\Infrastructure\UI\Frontend;

use Datamaq\Costs\Infrastructure\External\GoogleMapsClient;
use Datamaq\Costs\Domain\Repository\SettingsRepositoryInterface;

class AjaxHandler {
    private SettingsRepositoryInterface $settingsRepository;

    public function __construct(SettingsRepositoryInterface $settingsRepository) {
        $this->settingsRepository = $settingsRepository;
    }

    public function init(): void {
        add_action('wp_ajax_datamaq_calculate_costs', [$this, 'calculate_costs']);
        add_action('wp_ajax_nopriv_datamaq_calculate_costs', [$this, 'calculate_costs']);
        
        add_action('wp_ajax_datamaq_add_to_cart', [$this, 'add_to_cart']);
        add_action('wp_ajax_nopriv_datamaq_add_to_cart', [$this, 'add_to_cart']);
    }

    public function calculate_costs(): void {
        check_ajax_referer('datamaq_costs_nonce', '_ajax_nonce');

        $address = sanitize_text_field($_POST['address']);
        if (empty($address)) {
            wp_send_json_error('La dirección es obligatoria.');
        }

        $settings = $this->settingsRepository->getSettings();
        $client = new GoogleMapsClient($settings->getGoogleApiKey());
        
        // Calculamos la distancia usando el cliente existente
        $result = $client->getDistance('Garin, Buenos Aires, Argentina', $address);

        if (!$result['success']) {
            wp_send_json_error($result['message']);
        }

        $distanceKm = $result['distance_value'] / 1000;
        $basePrice = $settings->getBasePrice()->getAmount();
        $kmPrice = $settings->getKmPrice()->getAmount();

        $totalPrice = $basePrice + ($distanceKm * $kmPrice);

        wp_send_json_success([
            'distance' => $result['distance_text'],
            'price' => number_format($totalPrice, 2, '.', ''),
            'raw_price' => $totalPrice
        ]);
    }

    public function add_to_cart(): void {
        check_ajax_referer('datamaq_costs_nonce', '_ajax_nonce');

        $productId = intval($_POST['product_id']);
        $price = floatval($_POST['custom_price']);
        $address = sanitize_text_field($_POST['custom_address']);

        if (!$productId || !$price) {
            wp_send_json_error('Datos inválidos.');
        }

        // Guardamos los datos en la sesión de WooCommerce para el hook de cálculo de precio
        WC()->session->set('datamaq_custom_price', $price);
        WC()->session->set('datamaq_custom_address', $address);

        $passed = apply_filters('woocommerce_add_to_cart_validation', true, $productId, 1);

        if ($passed && WC()->cart->add_to_cart($productId, 1)) {
            wp_send_json_success();
        } else {
            wp_send_json_error('Error al añadir al carrito.');
        }
    }
}
