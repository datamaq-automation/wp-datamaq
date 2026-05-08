<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\HeroSection;

class HeroViewModel {
	private HeroSection $hero;

	public function __construct( ContentRepositoryInterface $repo ) {
		$this->hero = $repo->getHeroSection();
	}

	public function getEyebrow(): string {
		return $this->hero->getEyebrow(); }
	public function getTitle(): string {
		return $this->hero->getTitle(); }
	public function getSubtitle(): string {
		return $this->hero->getSubtitle(); }
	public function getCtaLabel(): string {
		return $this->hero->getCtaLabel(); }
	public function getStatusInfo(): string {
		return $this->hero->getStatusInfo(); }
	public function getTrustChips(): array {
		return $this->hero->getTrustChips(); }
	public function getImageUrl(): string {
		return $this->hero->getImagePath(); }

	public function getWhatsAppUrl(): string {
		// En un futuro esto vendría del BrandInfo si lo necesitamos centralizado
		return 'https://wa.me/5491156297160';
	}
}
