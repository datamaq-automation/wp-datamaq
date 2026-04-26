<?php
namespace DataMaq\Domain\Content;

interface ContentRepositoryInterface {
    /**
     * Get all site content data.
     * @return array
     */
    public function getAll(): array;

    /**
     * Get a specific section by key.
     * @param string $key
     * @return array|null
     */
    public function getSection(string $key): ?array;
}
