<?php

namespace Datamaq\Costs\Infrastructure\External;

/**
 * Cliente para interactuar con la API de Google Maps
 */
class GoogleMapsClient {

    private $api_key;

    public function __construct() {
        $this->api_key = get_option( 'datamaq_costs_google_api_key' );
    }

    /**
     * Calcula la distancia entre dos puntos usando Distance Matrix API
     * 
     * @param string $origin Dirección de origen
     * @param string $destination Dirección de destino
     * @return float|null Distancia en kilómetros o null si hay error
     */
    public function get_distance_km( $origin, $destination ) {
        if ( empty( $this->api_key ) ) {
            return null;
        }

        $url = sprintf(
            'https://maps.googleapis.com/maps/api/distancematrix/json?origins=%s&destinations=%s&key=%s',
            urlencode( $origin ),
            urlencode( $destination ),
            $this->api_key
        );

        $response = wp_remote_get( $url );

        if ( is_wp_error( $response ) ) {
            return null;
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( isset( $body['rows'][0]['elements'][0]['distance']['value'] ) ) {
            // Google devuelve metros, pasamos a KM
            return $body['rows'][0]['elements'][0]['distance']['value'] / 1000;
        }

        return null;
    }
}
