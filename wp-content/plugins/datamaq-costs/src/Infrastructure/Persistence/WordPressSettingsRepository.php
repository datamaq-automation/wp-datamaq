<?php

namespace Datamaq\Costs\Infrastructure\Persistence;

use Datamaq\Costs\Domain\Model\CostSettings;
use Datamaq\Costs\Domain\Repository\SettingsRepositoryInterface;

/**
 * Implementación del repositorio usando la API de opciones de WordPress
 */
class WordPressSettingsRepository implements SettingsRepositoryInterface {
    
    public function getSettings(): CostSettings {
        return new CostSettings(
            (string) get_option('datamaq_costs_google_api_key', ''),
            (string) get_option('datamaq_costs_origin_address', ''),
            (float)  get_option('datamaq_costs_base_fee', 0.0),
            (float)  get_option('datamaq_costs_km_rate', 0.0),
            (float)  get_option('datamaq_costs_engineering_rate', 0.0),
            (float)  get_option('datamaq_costs_assembly_rate', 0.0)
        );
    }

    public function saveSettings(CostSettings $settings): void {
        update_option('datamaq_costs_google_api_key', $settings->getGoogleApiKey());
        update_option('datamaq_costs_origin_address', $settings->getOriginAddress());
        update_option('datamaq_costs_base_fee', $settings->getBaseFee());
        update_option('datamaq_costs_km_rate', $settings->getKmRate());
        update_option('datamaq_costs_engineering_rate', $settings->getEngineeringRate());
        update_option('datamaq_costs_assembly_rate', $settings->getAssemblyRate());
    }
}
