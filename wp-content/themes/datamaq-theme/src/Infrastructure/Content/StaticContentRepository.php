<?php
namespace DataMaq\Infrastructure\Content;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class StaticContentRepository implements ContentRepositoryInterface {
    private array $data;

    public function __construct() {
        // We use the global function as a temporary source
        if (function_exists('get_datamaq_site_data')) {
            $this->data = get_datamaq_site_data();
        } else {
            $this->data = [];
        }
    }

    public function getAll(): array {
        return $this->data;
    }

    public function getSection(string $key): ?array {
        return $this->data[$key] ?? null;
    }
}
