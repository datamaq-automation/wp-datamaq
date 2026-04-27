<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\ServicesSection;

class ServicesViewModel {
    private ServicesSection $section;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->section = $repo->getServicesSection();
    }

    public function getEyebrow(): string {
        return $this->section->getEyebrow();
    }

    public function getTitle(): string {
        return $this->section->getTitle();
    }

    public function getIntro(): string {
        return $this->section->getIntro();
    }

    public function getServices(): array {
        return $this->section->getServices();
    }
}
