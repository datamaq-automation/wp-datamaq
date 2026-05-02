<?php

namespace Datamaq\Costs\Infrastructure\External;

use Datamaq\Costs\Domain\Services\DistanceServiceInterface;

/**
 * Cliente para interactuar con la API de Google Maps
 */
class GoogleMapsClient implements DistanceServiceInterface {

    private string $api_key;
    private ?string $last_error = null;

    public function __construct(string $api_key) {
        $this->api_key = $api_key;
    }

    /**
     * Calcula la distancia entre dos puntos usando Distance Matrix API
     */
    public function getDistanceKm(string $origin, string $destination): ?float {
        $this->last_error = null;

        if (empty($this->api_key)) {
            $this->last_error = 'API Key is empty.';
            return null;
        }

        $url = sprintf(
            'https://maps.googleapis.com/maps/api/distancematrix/json?origins=%s&destinations=%s&key=%s',
            urlencode($origin),
            urlencode($destination),
            $this->api_key
        );

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            $this->last_error = $response->get_error_message();
            return null;
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);

        // Verificar status de nivel superior
        if (isset($body['status']) && $body['status'] !== 'OK') {
            $this->last_error = $body['status'] . (isset($body['error_message']) ? ': ' . $body['error_message'] : '');
            return null;
        }

        // Verificar status del elemento
        if (isset($body['rows'][0]['elements'][0]['status']) && $body['rows'][0]['elements'][0]['status'] !== 'OK') {
            $this->last_error = 'Element status: ' . $body['rows'][0]['elements'][0]['status'];
            return null;
        }

        if (isset($body['rows'][0]['elements'][0]['distance']['value'])) {
            return $body['rows'][0]['elements'][0]['distance']['value'] / 1000;
        }

        $this->last_error = 'Unexpected response format.';
        return null;
    }

    public function getLastError(): ?string {
        return $this->last_error;
    }
}
