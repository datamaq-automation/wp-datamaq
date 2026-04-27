<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class ContactViewModel {
    private array $data;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->data = $repo->getSection('contactPage') ?? [];
    }

    public function getEyebrow(): string {
        return $this->data['eyebrow'] ?? '¿Hablamos?';
    }

    public function getTitle(): string {
        return $this->data['title'] ?? 'Iniciar proyecto';
    }

    public function getStepText(int $current, int $total): string {
        return sprintf('Paso %d de %d', $current, $total);
    }

    public function getPlaceholderName(): string {
        return $this->data['placeholderName'] ?? 'Ej: Agustín';
    }

    public function getPlaceholderMsg(): string {
        return $this->data['placeholderMsg'] ?? 'Describí tu caso técnico...';
    }
}
