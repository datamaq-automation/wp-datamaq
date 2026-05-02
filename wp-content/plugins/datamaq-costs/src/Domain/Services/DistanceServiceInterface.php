<?php

namespace Datamaq\Costs\Domain\Services;

/**
 * Interfaz para el servicio de cálculo de distancias
 */
interface DistanceServiceInterface {
    /**
     * Calcula la distancia en KM entre dos direcciones
     */
    public function getDistanceKm(string $origin, string $destination): ?float;
}
