<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\ContactPage;

class ContactPageViewModel {
	private ContactPage $page;

	public function __construct( ContentRepositoryInterface $repo ) {
		$this->page = $repo->getFullContactPage();
	}

	public function getTitle(): string {
		return $this->page->getTitle();
	}

	public function getIntroCopy(): string {
		return $this->page->getIntroCopy();
	}

	public function getSupportChannels(): array {
		return $this->page->getSupportChannels();
	}

	public function getTechnicianName(): string {
		return $this->page->getTechnicianName();
	}

	public function getTechnicianAvatar(): string {
		return $this->page->getTechnicianAvatar();
	}

	public function getHomeLink(): string {
		return home_url( '/' );
	}

	public function getServicesLink(): string {
		return home_url( '/#servicios' );
	}
}
