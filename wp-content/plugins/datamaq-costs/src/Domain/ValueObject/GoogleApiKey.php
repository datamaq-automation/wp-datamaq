<?php

namespace Datamaq\Costs\Domain\ValueObject;

use InvalidArgumentException;

/**
 * Representa una API Key de Google Cloud
 */
class GoogleApiKey {
    private string $value;

    public function __construct(string $value) {
        $this->value = trim($value);
    }

    public function getValue(): string {
        return $this->value;
    }

    public function isEmpty(): bool {
        return empty($this->value);
    }

    public function __toString(): string {
        return $this->value;
    }
}
