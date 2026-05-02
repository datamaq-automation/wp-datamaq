<?php

namespace Datamaq\Costs\Domain\Repository;

use Datamaq\Costs\Domain\Model\CostSettings;

/**
 * Interfaz para el repositorio de configuraciones
 */
interface SettingsRepositoryInterface {
    /**
     * Obtiene la configuración actual
     */
    public function getSettings(): CostSettings;

    /**
     * Guarda la configuración
     */
    public function saveSettings(CostSettings $settings): void;
}
