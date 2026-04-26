<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class HeroViewModel {
    private array $data;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->data = $repo->getSection('hero') ?? [];
    }

    public function getTitle(): string {
        return $this->data['title'] ?? 'Soluciones IoT para Energía y Producción';
    }

    public function getDescription(): string {
        return $this->data['description'] ?? '';
    }

    public function getImageUrl(): string {
        return esc_url($this->data['image'] ?? '');
    }

    public function getPrimaryCtaText(): string {
        return 'Consultar ahora';
    }

    public function getSecondaryCtaText(): string {
        return 'Ver alcance técnico';
    }
}
