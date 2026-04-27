<?php
namespace DataMaq\Infrastructure\Content;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\ProfileSection;
use DataMaq\Domain\Content\ServicesSection;
use DataMaq\Domain\Content\ServiceItem;
use DataMaq\Domain\Shared\Validation\ContentValidator;

class StaticContentRepository implements ContentRepositoryInterface {
    private array $data;

    public function __construct() {
        if (function_exists('get_datamaq_site_data')) {
            $this->data = get_datamaq_site_data();
        } else {
            $this->data = [];
        }

        // Validation - Blindage
        if (class_exists('DataMaq\Domain\Shared\Validation\ContentValidator')) {
            try {
                \DataMaq\Domain\Shared\Validation\ContentValidator::validate($this->data);
            } catch (\Throwable $e) {
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    error_log('DataMaq Content Validation Error: ' . $e->getMessage());
                }
            }
        }
    }

    public function getAll(): array {
        return $this->data;
    }

    public function getSection(string $key): ?array {
        return $this->data[$key] ?? null;
    }

    public function getProfileSection(): ProfileSection {
        $data = $this->data['profile'] ?? [];
        
        return new ProfileSection(
            $data['name'] ?? 'Agustin Bustos',
            $data['role'] ?? 'Sobre DataMaq',
            $data['lead'] ?? '',
            $data['how_i_work'] ?? '',
            $data['photo'] ?? '',
            $data['bullets'] ?? [],
            $data['whatsappLabel'] ?? 'Escribime directo por WhatsApp'
        );
    }

    public function getServicesSection(): ServicesSection {
        $data = $this->data['services'] ?? [];
        $services = [];

        foreach (($data['cards'] ?? []) as $card) {
            $services[] = new ServiceItem(
                $card['title'] ?? '',
                $card['description'] ?? '',
                $card['subtitle'] ?? '',
                $card['items'] ?? [],
                $card['note'] ?? '',
                $card['cta']['label'] ?? '',
                $card['icon'] ?? 'bi-check2-circle'
            );
        }

        return new ServicesSection(
            $data['eyebrow'] ?? 'Servicios',
            $data['title'] ?? '',
            $data['intro'] ?? '',
            $services
        );
    }
}
