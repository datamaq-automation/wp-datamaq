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
        error_log("[DataMaq Debug] Iniciando cálculo de costos para: " . ($_POST['address'] ?? 'VACÍO'));
        
        check_ajax_referer('datamaq_costs_nonce', '_ajax_nonce');

        $address = sanitize_text_field($_POST['address']);
        if (empty($address)) {
            error_log("[DataMaq Debug] Error: Dirección vacía");
            wp_send_json_error('La dirección es obligatoria.');
        }

        $settings = $this->settingsRepository->getSettings();
        $origin = $settings->getOriginAddress();
        
        error_log("[DataMaq Debug] Origen configurado: " . $origin);
        
        $client = new GoogleMapsClient($settings->getGoogleApiKey());
        $result = $client->getDistance($origin, $address);

        if (!$result['success']) {
            error_log("[DataMaq Debug] Error de Google Maps: " . $result['message']);
            wp_send_json_error($result['message']);
        }

        $distanceKm = $result['distance_value'] / 1000;
        $basePrice = $settings->getBaseFee()->getAmount(); // Corregido nombre de método según CostSettings
        $kmPrice = $settings->getKmRate()->getAmount();    // Corregido nombre de método según CostSettings

        $totalPrice = $basePrice + ($distanceKm * $kmPrice);

        // Generar un token de seguridad para evitar manipulación en el frontend
        $calculationToken = md5(uniqid($address, true));
        $calculationData = [
            'address' => $address,
            'distance' => $result['distance_text'],
            'price' => $totalPrice
        ];
        
        // Guardar por 1 hora
        set_transient('dm_calc_' . $calculationToken, $calculationData, HOUR_IN_SECONDS);

        error_log("[DataMaq Debug] Cálculo exitoso. Token generado: " . $calculationToken);

        wp_send_json_success([
            'token' => $calculationToken,
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
