<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\FaqSection;

class FaqViewModel {
	private FaqSection $section;

	public function __construct( ContentRepositoryInterface $repo ) {
		$this->section = $repo->getFaqSection();
	}

	public function getEyebrow(): string {
		return $this->section->getEyebrow();
	}

	public function getTitle(): string {
		return $this->section->getTitle();
	}

	public function getItems(): array {
		return $this->section->getItems();
	}
}
