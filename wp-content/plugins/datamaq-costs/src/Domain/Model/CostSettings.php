<?php

namespace Datamaq\Costs\Domain\Model;

/**
 * Representa la configuración de costos del sistema
 */
class CostSettings {
    private string $google_api_key;
    private string $origin_address;
    private float $base_fee;
    private float $km_rate;
    private float $engineering_rate;
    private float $assembly_rate;

    public function __construct(
        string $google_api_key,
        string $origin_address,
        float $base_fee,
        float $km_rate,
        float $engineering_rate,
        float $assembly_rate
    ) {
        $this->google_api_key = $google_api_key;
        $this->origin_address = $origin_address;
        $this->base_fee = $base_fee;
        $this->km_rate = $km_rate;
        $this->engineering_rate = $engineering_rate;
        $this->assembly_rate = $assembly_rate;
    }

    public function getGoogleApiKey(): string {
        return $this->google_api_key;
    }

    public function getOriginAddress(): string {
        return $this->origin_address;
    }

    public function getBaseFee(): float {
        return $this->base_fee;
    }

    public function getKmRate(): float {
        return $this->km_rate;
    }

    public function getEngineeringRate(): float {
        return $this->engineering_rate;
    }

    public function getAssemblyRate(): float {
        return $this->assembly_rate;
    }
}
