<?php

namespace Datamaq\Costs\Infrastructure\UI\Admin;

use Datamaq\Costs\Application\UseCases\ValidateGoogleMapsKey;
use Datamaq\Costs\Infrastructure\External\GoogleMapsClient;

/**
 * Maneja las peticiones AJAX desde el panel de administración
 */
class AjaxHandler {

    public function __construct() {
        add_action('wp_ajax_datamaq_test_google_key', [$this, 'test_google_key']);
    }

    public function test_google_key() {
        check_ajax_referer('datamaq_costs_admin', 'security');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'No tienes permisos suficientes.']);
        }

        $api_key = sanitize_text_field($_POST['api_key']);
        $address = sanitize_text_field($_POST['address']);

        if (empty($address)) {
            $address = 'Buenos Aires, Argentina'; // Fallback para test
        }

        $client = new GoogleMapsClient($api_key);
        $useCase = new ValidateGoogleMapsKey($client);
        
        $result = $useCase->execute($api_key, $address);

        if ($result['success']) {
            wp_send_json_success($result);
        } else {
            wp_send_json_error($result);
        }
    }
}
