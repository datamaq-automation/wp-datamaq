<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for the Contact Wizard Section.
 */
class ContactSection {
    private string $title;
    private string $subtitle;
    private array $steps;
    private string $alternativeEmail;

    public function __construct(string $title, string $subtitle, array $steps, string $alternativeEmail) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->steps = $steps;
        $this->alternativeEmail = $alternativeEmail;
    }

    public function getTitle(): string { return $this->title; }
    public function getSubtitle(): string { return $this->subtitle; }
    public function getSteps(): array { return $this->steps; }
    public function getAlternativeEmail(): string { return $this->alternativeEmail; }
}
