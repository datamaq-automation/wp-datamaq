<?php

namespace Datamaq\Costs\Infrastructure\Logging;

use Datamaq\Costs\Domain\Services\LoggerInterface;

/**
 * Implementación de Logger usando el log de errores de WordPress
 */
class WordPressLogger implements LoggerInterface {

    public function info(string $message, array $context = []): void {
        $this->log('INFO', $message, $context);
    }

    public function error(string $message, array $context = []): void {
        $this->log('ERROR', $message, $context);
    }

    public function warning(string $message, array $context = []): void {
        $this->log('WARNING', $message, $context);
    }

    private function log(string $level, string $message, array $context): void {
        if (!defined('WP_DEBUG') || !WP_DEBUG) {
            return;
        }

        $formatted_message = sprintf(
            '[Datamaq Costs - %s] %s %s',
            $level,
            $message,
            !empty($context) ? json_encode($context) : ''
        );

        error_log($formatted_message);
    }
}
