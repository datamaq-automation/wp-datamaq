<?php

namespace Datamaq\Costs\Infrastructure\Persistence;

use Datamaq\Costs\Domain\Model\CostSettings;
use Datamaq\Costs\Domain\Repository\SettingsRepositoryInterface;
use Datamaq\Costs\Domain\ValueObject\GoogleApiKey;
use Datamaq\Costs\Domain\ValueObject\Money;

/**
 * Implementación del repositorio usando la API de opciones de WordPress
 */
class WordPressSettingsRepository implements SettingsRepositoryInterface {
    
    public function getSettings(): CostSettings {
        return new CostSettings(
            new GoogleApiKey((string) get_option('datamaq_costs_google_api_key', '')),
            (string) get_option('datamaq_costs_origin_address', ''),
            new Money((float)  get_option('datamaq_costs_base_fee', 0.0)),
            new Money((float)  get_option('datamaq_costs_km_rate', 0.0)),
            new Money((float)  get_option('datamaq_costs_engineering_rate', 0.0)),
            new Money((float)  get_option('datamaq_costs_assembly_rate', 0.0))
        );
    }

    public function saveSettings(CostSettings $settings): void {
        update_option('datamaq_costs_google_api_key', $settings->getGoogleApiKey()->getValue());
        update_option('datamaq_costs_origin_address', $settings->getOriginAddress());
        update_option('datamaq_costs_base_fee', $settings->getBaseFee()->getAmount());
        update_option('datamaq_costs_km_rate', $settings->getKmRate()->getAmount());
        update_option('datamaq_costs_engineering_rate', $settings->getEngineeringRate()->getAmount());
        update_option('datamaq_costs_assembly_rate', $settings->getAssemblyRate()->getAmount());
    }
}
