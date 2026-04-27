<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class ProfileViewModel {
    private array $data;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->data = $repo->getSection('profile') ?? [];
    }

    public function getName(): string {
        return $this->data['name'] ?? 'Agustin Bustos';
    }

    public function getRole(): string {
        return $this->data['role'] ?? 'Técnico en Automatización y Datos';
    }

    public function getPhotoUrl(): string {
        return $this->data['photo'] ?? '';
    }

    public function getIntroduction(): string {
        return $this->data['introduction'] ?? 'DataMaq trabaja sobre captura automática de datos operativos, con foco en energía eléctrica y producción.';
    }

    public function getHowIWork(): string {
        return $this->data['how_i_work'] ?? 'Relevamiento en sitio y criterio de implementación. Instalación, integración y puesta en marcha para captura automática de datos.';
    }

    public function getItems(): array {
        return $this->data['items'] ?? [];
    }

    public function getBenefitIcon(string $text): string {
        $normalized = strtolower($text);
        $icons = [
            'ahorro' => 'bi-cash-coin',
            'prevent' => 'bi-shield-check',
            'diagn' => 'bi-activity',
            'tiempo' => 'bi-stopwatch',
            'parada' => 'bi-lightning-charge-fill',
            'repuesto' => 'bi-box-seam'
        ];
        foreach ($icons as $keyword => $icon) {
            if (strpos($normalized, $keyword) !== false) return $icon;
        }
        return 'bi-check2-circle';
    }
}
