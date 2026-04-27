<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class FaqViewModel {
    private array $data;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->data = $repo->getSection('faq') ?? [];
    }

    public function getEyebrow(): string {
        return $this->data['eyebrow'] ?? 'Ayuda';
    }

    public function getTitle(): string {
        return $this->data['title'] ?? 'Preguntas Frecuentes';
    }

    public function getIntro(): string {
        return $this->data['intro'] ?? 'Todo lo que necesitás saber sobre nuestras soluciones y metodología.';
    }

    public function getItems(): array {
        return $this->data['items'] ?? [];
    }
}
