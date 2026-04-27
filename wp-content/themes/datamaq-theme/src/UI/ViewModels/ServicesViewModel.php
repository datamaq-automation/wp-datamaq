<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class ServicesViewModel {
    private array $data;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->data = $repo->getSection('services') ?? [];
    }

    public function getEyebrow(): string {
        return $this->data['eyebrow'] ?? 'Servicios';
    }

    public function getTitle(): string {
        return $this->data['title'] ?? 'Nuestros Servicios';
    }

    public function getIntro(): string {
        return $this->data['intro'] ?? '';
    }

    public function getCards(): array {
        return $this->data['cards'] ?? [];
    }
}
