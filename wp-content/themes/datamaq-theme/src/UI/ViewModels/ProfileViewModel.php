<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\ProfileSection;

class ProfileViewModel {
	private ProfileSection $profile;

	public function __construct( ContentRepositoryInterface $repo ) {
		$this->profile = $repo->getProfileSection();
	}

	public function getName(): string {
		return $this->profile->getName();
	}

	public function getRole(): string {
		return $this->profile->getRole();
	}

	public function getPhotoUrl(): string {
		return $this->profile->getPhotoUrl();
	}

	public function getIntroduction(): string {
		return $this->profile->getIntroduction();
	}

	public function getHowIWork(): string {
		return $this->profile->getHowIWork();
	}

	public function getItems(): array {
		return $this->profile->getBenefits();
	}

	public function getBenefitIcon( string $text ): string {
		$normalized = strtolower( $text );
		$icons      = array(
			'ahorro'   => 'bi-cash-coin',
			'prevent'  => 'bi-shield-check',
			'diagn'    => 'bi-activity',
			'tiempo'   => 'bi-stopwatch',
			'parada'   => 'bi-lightning-charge-fill',
			'repuesto' => 'bi-box-seam',
		);
		foreach ( $icons as $keyword => $icon ) {
			if ( strpos( $normalized, $keyword ) !== false ) {
				return $icon;
			}
		}
		return 'bi-check2-circle';
	}
}
