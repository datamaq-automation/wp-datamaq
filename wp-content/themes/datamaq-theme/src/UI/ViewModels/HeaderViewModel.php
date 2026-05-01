<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\BrandInfo;

class HeaderViewModel {
    private BrandInfo $brand;

    public function __construct(ContentRepositoryInterface $repo) {
        $this->brand = $repo->getBrandInfo();
    }

    public function getSiteName(): string {
        return $this->brand->getName();
    }

    public function getNavigation(): array {
        return $this->brand->getNavigation();
    }

    public function getContactUrl(): string {
        return $this->brand->getContactUrl();
    }

    public function getTrainingUrl(): string {
        return $this->brand->getTrainingUrl();
    }

    public function getProductsUrl(): string {
        return $this->brand->getProductsUrl();
    }

    public function getHomeUrl(): string {
        return home_url('/');
    }
}
