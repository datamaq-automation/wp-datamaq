<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class HeroViewModel {
    private array $data;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->data = $repo->getSection('hero') ?? [];
    }

    public function getTitle(): string {
        return $this->data['title'] ?? 'Instalación e integración de equipos IoT para energía y producción';
    }

    public function getDescription(): string {
        return $this->data['description'] ?? 'Implementación de soluciones para medir variables eléctricas y operativas, integrarlas a sistemas existentes y dejar una base técnica usable para seguimiento, diagnóstico y capacitación.';
    }

    public function getImageUrl(): string {
        return $this->data['image'] ?? '';
    }

    public function getPrimaryCtaText(): string {
        return $this->data['cta_primary'] ?? 'Escribime por WhatsApp';
    }

    public function getSecondaryCtaText(): string {
        return $this->data['cta_secondary'] ?? 'Ver alcance técnico';
    }

    public function getTrustChips(): array {
        return $this->data['trust_chips'] ?? [
            'Base operativa: Garín (GBA Norte). El alcance se define según tablero, señales disponibles, conectividad, sistema destino y objetivo operativo.',
            'Instalación de equipos IoT para captura de datos',
            'Asesoramiento técnico para análisis de datos'
        ];
    }

    public function getSignals(): array {
        return $this->data['signals'] ?? [
            'Base operativa: Garín (GBA Norte). El alcance se define según tablero, señales disponibles, conectividad, sistema destino y objetivo operativo.'
        ];
    }
}
