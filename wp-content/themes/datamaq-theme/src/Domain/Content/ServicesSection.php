<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for the Services Section.
 */
class ServicesSection {
    private string $eyebrow;
    private string $title;
    private string $intro;
    private array $services;

    /**
     * @param string $eyebrow
     * @param string $title
     * @param string $intro
     * @param ServiceItem[] $services
     */
    public function __construct(
        string $eyebrow,
        string $title,
        string $intro,
        array $services
    ) {
        $this->eyebrow = $eyebrow;
        $this->title = $title;
        $this->intro = $intro;
        $this->services = $services;
    }

    public function getEyebrow(): string { return $this->eyebrow; }
    public function getTitle(): string { return $this->title; }
    public function getIntro(): string { return $this->intro; }
    public function getServices(): array { return $this->services; }
}
