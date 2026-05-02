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

        return [
            'success' => false, 
            'message' => 'Error de conexión o API Key inválida.',
            'technical_details' => $this->distanceService->getLastError()
        ];
    }
}
