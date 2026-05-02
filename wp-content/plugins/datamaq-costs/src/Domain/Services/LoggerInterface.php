<?php

namespace Datamaq\Costs\Domain\Services;

/**
 * Interfaz para la observabilidad del sistema
 */
interface LoggerInterface {
    public function info(string $message, array $context = []): void;
    public function error(string $message, array $context = []): void;
    public function warning(string $message, array $context = []): void;
}
