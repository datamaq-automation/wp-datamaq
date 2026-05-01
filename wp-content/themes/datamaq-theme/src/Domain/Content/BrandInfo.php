<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for Brand Identity and Header Configuration.
 */
class BrandInfo {
    private string $name;
    private array $navigation;
    private string $contactUrl;
    private string $trainingUrl;
    private string $whatsapp;

    public function __construct(
        string $name,
        array $navigation,
        string $contactUrl,
        string $trainingUrl,
        string $whatsapp
    ) {
        $this->name = $name;
        $this->navigation = $navigation;
        $this->contactUrl = $contactUrl;
        $this->trainingUrl = $trainingUrl;
        $this->whatsapp = $whatsapp;
    }

    public function getName(): string { return $this->name; }
    public function getNavigation(): array { return $this->navigation; }
    public function getContactUrl(): string { return $this->contactUrl; }
    public function getTrainingUrl(): string { return $this->trainingUrl; }
    public function getWhatsapp(): string { return $this->whatsapp; }
}
