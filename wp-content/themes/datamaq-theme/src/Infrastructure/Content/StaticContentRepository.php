<?php
namespace DataMaq\Infrastructure\Content;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Shared\Validation\ContentValidator;

class StaticContentRepository implements ContentRepositoryInterface {
    private array $data;

    public function __construct() {
        if (function_exists('get_datamaq_site_data')) {
            $this->data = get_datamaq_site_data();
        } else {
            $this->data = [];
        }

        // Validation - Phase 4 Blindage
        try {
            ContentValidator::validate($this->data);
        } catch (\Exception $e) {
            // In a real environment we might log this or handle it gracefully
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log('DataMaq Content Validation Error: ' . $e->getMessage());
            }
        }
    }

    public function getAll(): array {
        return $this->data;
    }

    public function getSection(string $key): ?array {
        return $this->data[$key] ?? null;
    }
}
