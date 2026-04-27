<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\ContactSection;

class ContactViewModel {
    private ContactSection $section;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->section = $repo->getContactSection();
    }

    public function getTitle(): string {
        return $this->section->getTitle();
    }

    public function getSubtitle(): string {
        return $this->section->getSubtitle();
    }

    public function getSteps(): array {
        return $this->section->getSteps();
    }

    public function getAlternativeEmail(): string {
        return $this->section->getAlternativeEmail();
    }

    public function getProgressText(int $current, int $total): string {
        return sprintf('Paso %d de %d', $current, $total);
    }
}
