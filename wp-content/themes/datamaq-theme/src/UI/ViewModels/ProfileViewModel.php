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
        return $this->data['role'] ?? 'Sobre DataMaq';
    }

    public function getPhotoUrl(): string {
        return $this->data['photo'] ?? get_template_directory_uri() . '/assets/media/tecnico-a-cargo.webp';
    }

    public function getIntroduction(): string {
        return $this->data['introduction'] ?? 'DataMaq trabaja sobre captura automática de datos operativos, con foco en energía eléctrica, producción y variables críticas de seguimiento.';
    }

    public function getHowIWork(): string {
        return $this->data['how_i_work'] ?? 'El servicio combina relevamiento en campo, implementación técnica, integración inicial y acompañamiento para que los datos capturados puedan usarse con criterio en análisis, seguimiento o capacitación.';
    }

    public function getItems(): array {
        return $this->data['items'] ?? [
            'Relevamiento en sitio y criterio de implementación.',
            'Instalación, integración y puesta en marcha para captura automática de datos.',
            'Asesoramiento y capacitaciones sobre Python, datos, bases de datos y APIs en contextos reales.'
        ];
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
