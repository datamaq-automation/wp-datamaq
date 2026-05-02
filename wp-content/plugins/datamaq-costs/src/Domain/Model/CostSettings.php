<?php

namespace Datamaq\Costs\Domain\Model;

use Datamaq\Costs\Domain\ValueObject\GoogleApiKey;
use Datamaq\Costs\Domain\ValueObject\Money;

/**
 * Representa la configuración de costos del sistema
 */
class CostSettings {
    private GoogleApiKey $google_api_key;
    private string $origin_address;
    private Money $base_fee;
    private Money $km_rate;
    private Money $engineering_rate;
    private Money $assembly_rate;
    private bool $chatwoot_enabled;

    public function __construct(
        GoogleApiKey $google_api_key,
        string $origin_address,
        Money $base_fee,
        Money $km_rate,
        Money $engineering_rate,
        Money $assembly_rate,
        bool $chatwoot_enabled = true
    ) {
        $this->google_api_key = $google_api_key;
        $this->origin_address = $origin_address;
        $this->base_fee = $base_fee;
        $this->km_rate = $km_rate;
        $this->engineering_rate = $engineering_rate;
        $this->assembly_rate = $assembly_rate;
        $this->chatwoot_enabled = $chatwoot_enabled;
    }

    public function getGoogleApiKey(): GoogleApiKey {
        return $this->google_api_key;
    }

    public function getOriginAddress(): string {
        return $this->origin_address;
    }

    public function getBaseFee(): Money {
        return $this->base_fee;
    }

    public function getKmRate(): Money {
        return $this->km_rate;
    }

    public function getEngineeringRate(): Money {
        return $this->engineering_rate;
    }

    public function getAssemblyRate(): Money {
        return $this->assembly_rate;
    }

    public function isChatwootEnabled(): bool {
        return $this->chatwoot_enabled;
    }
}
