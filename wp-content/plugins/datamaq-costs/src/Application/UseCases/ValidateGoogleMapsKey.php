<?php

namespace Datamaq\Costs\Application\UseCases;

use Datamaq\Costs\Domain\Services\DistanceServiceInterface;

/**
 * Caso de uso para validar si una API Key de Google Maps es funcional
 */
class ValidateGoogleMapsKey {
    private DistanceServiceInterface $distanceService;

    public function __construct(DistanceServiceInterface $distanceService) {
        $this->distanceService = $distanceService;
    }

    /**
     * Intenta realizar una consulta mínima para validar la key
     * 
     * @param string $apiKey La clave a probar
     * @return array [success => bool, message => string]
     */
    public function execute(string $apiKey, string $testAddress): array {
        if (empty($apiKey)) {
            return ['success' => false, 'message' => 'La API Key está vacía.'];
        }

        $distance = $this->distanceService->getDistanceKm($testAddress, $testAddress);

        if ($distance !== null) {
            return [
                'success' => true, 
                'message' => 'Conexión exitosa con Google Maps API.'
            ];
        }

        $technicalError = $this->distanceService->getLastError();
        $suggestion = null;
        $link = null;

        if ($technicalError) {
            if (strpos($technicalError, 'REQUEST_DENIED') !== false) {
                $suggestion = 'Asegúrate de que la "Distance Matrix API" esté habilitada en tu consola de Google Cloud.';
                $link = 'https://console.cloud.google.com/apis/library/distancematrix.googleapis.com';
            } elseif (strpos($technicalError, 'OVER_QUERY_LIMIT') !== false) {
                $suggestion = 'Has excedido tu cuota o la facturación no está habilitada.';
                $link = 'https://console.cloud.google.com/billing';
            } elseif (strpos($technicalError, 'InvalidKeyMapError') !== false) {
                $suggestion = 'La API Key parece ser inválida. Verifica que esté copiada correctamente.';
                $link = 'https://console.cloud.google.com/apis/credentials';
            }
        }

        return [
            'success' => false, 
            'message' => 'Error de conexión o API Key inválida.',
            'technical_details' => $technicalError,
            'suggestion' => $suggestion,
            'link' => $link
        ];
    }
}
