<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

class ProcessViewModel {
	private array $data;

	public function __construct( ContentRepositoryInterface $repo ) {
		$this->data = $repo->getSection( 'process' ) ?? array();
	}

	public function getEyebrow(): string {
		return $this->data['eyebrow'] ?? 'Metodología';
	}

	public function getTitle(): string {
		return $this->data['title'] ?? 'Cómo trabajamos';
	}

	public function getSteps(): array {
		return $this->data['steps'] ?? array();
	}
}
