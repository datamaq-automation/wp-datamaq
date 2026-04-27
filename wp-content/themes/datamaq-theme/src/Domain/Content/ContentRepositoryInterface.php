<?php
namespace DataMaq\Domain\Content;

interface ContentRepositoryInterface {
    /**
     * Get all site content data.
     * @return array
     */
    public function getAll(): array;

    /**
     * Get a specific section by key (Legacy Support).
     * @param string $key
     * @return array|null
     */
    public function getSection(string $key): ?array;

    /**
     * Get the contact section domain model.
     * @return ContactSection
     */
    public function getContactSection(): ContactSection;
}
