<?php

namespace Datamaq\Costs\Domain\ValueObject;

use InvalidArgumentException;

/**
 * Representa un valor monetario dentro del sistema
 */
class Money {
    private float $amount;

    public function __construct(float $amount) {
        if ($amount < 0) {
            throw new InvalidArgumentException("El monto no puede ser negativo.");
        }
        $this->amount = $amount;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function format(): string {
        return number_format($this->amount, 2, ',', '.');
    }

    public function __toString(): string {
        return (string)$this->amount;
    }
}
