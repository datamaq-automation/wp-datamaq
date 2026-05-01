<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\FooterSection;

class FooterViewModel {
    private FooterSection $footer;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->footer = $repo->getFooterSection();
    }

    public function getHomeUrl(): string {
        return home_url('/');
    }

    public function getContactUrl(): string {
        return home_url('/contacto');
    }

    public function getWhatsAppUrl(): string {
        return $this->footer->getWhatsappUrl();
    }

    public function getProductsUrl(): string {
        return home_url('/productos');
    }

    public function getTrainingUrl(): string {
        return home_url('/courses');
    }

    public function getCopyright(): string {
        return $this->footer->getCopyrightNote();
    }

    public function getLegalText(): string {
        return $this->footer->getLegalText();
    }
}
