<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class FooterViewModel {
    private array $data;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->data = $repo->getSection('brand') ?? [];
    }

    public function getHomeUrl(): string {
        return home_url('/');
    }

    public function getContactUrl(): string {
        return home_url('/contacto');
    }

    public function getWhatsAppUrl(): string {
        return $this->data['whatsapp'] ?? 'https://wa.me/5491156297160';
    }

    public function getCopyright(): string {
        return sprintf('© %d DataMaq. Todos los derechos reservados.', date('Y'));
    }
}
