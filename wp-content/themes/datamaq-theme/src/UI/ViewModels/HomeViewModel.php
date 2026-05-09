<?php
namespace DataMaq\UI\ViewModels;

use DataMaq\Domain\Content\ContentRepositoryInterface;

/**
 * HomeViewModel - Brain of the Native Home Page.
 * Handles variant resolution, icon mapping, and derived content.
 */
class HomeViewModel {
	private ContentRepositoryInterface $repo;
	private string $variant;
	private array $data;

	public function __construct( ContentRepositoryInterface $repo ) {
		$this->repo    = $repo;
		$this->variant = $this->resolveVariant();
		$this->data    = $this->repo->getAll();
	}

	/**
	 * Resolve the current home variant (direct vs authority).
	 */
	private function resolveVariant(): string {
		$url_variant = isset( $_GET['variant'] ) ? sanitize_text_field( $_GET['variant'] ) : '';
		
		// Priority 1: URL Parameter
		if ( in_array( $url_variant, array( 'authority', 'trust', 'confianza' ) ) ) {
			return 'authority';
		}
		
		// Priority 2: Cookie (Persistence)
		if ( isset( $_COOKIE['dm_variant'] ) && $_COOKIE['dm_variant'] === 'authority' ) {
			return 'authority';
		}

		return 'direct';
	}

	public function getVariant(): string {
		return $this->variant;
	}

	public function isDirect(): bool {
		return $this->variant === 'direct';
	}

	public function isAuthority(): bool {
		return $this->variant === 'authority';
	}

	/**
	 * Get derived Trust Signals (Logic ported from HomePage.ts)
	 */
	public function getTrustSignals(): array {
		$hero     = $this->repo->getHeroSection();
		$services = $this->repo->getServicesSection();
		$profile  = $this->repo->getProfileSection();

		$signals = array();
		
		// 1. From Hero
		$hero_parts = explode( ' · ', $hero->getStatusInfo() );
		foreach ( $hero_parts as $part ) {
			$signals[] = trim( $part );
		}

		// 2. From Services
		foreach ( $services->getServices() as $service ) {
			$signals[] = $service->getTitle();
		}

		// 3. From Profile
		foreach ( $profile->getBenefits() as $bullet ) {
			$signals[] = trim( $bullet );
		}

		return array_values( array_unique( array_filter( $signals ) ) );
	}

	/**
	 * Map icons for services based on keywords (Ported from HomePage.ts)
	 */
	public function getServiceIcon( string $id, string $title ): string {
		$keywords = array(
			'python'       => 'bi-bar-chart-line-fill',
			'datos'        => 'bi-bar-chart-line-fill',
			'base de datos' => 'bi-database-fill',
			'api'          => 'bi-diagram-3-fill',
			'mantenimiento' => 'bi-tools',
			'repar'        => 'bi-wrench-adjustable-circle-fill',
			'consult'      => 'bi-graph-up-arrow',
			'instal'       => 'bi-lightning-charge-fill',
			'medic'        => 'bi-speedometer2',
			'diag'         => 'bi-cpu-fill',
		);

		$key = strtolower( $id . ' ' . $title );
		foreach ( $keywords as $word => $icon ) {
			if ( strpos( $key, $word ) !== false ) {
				return $icon;
			}
		}

		return 'bi-gear-wide-connected';
	}

	/**
	 * Get Navbar Links (filtered by variant like legacy)
	 */
	public function getHeaderLinks(): array {
		$brand = $this->repo->getBrandInfo();
		$links = array(
			array( 'label' => 'Servicios', 'href' => '#servicios' ),
			array( 'label' => 'Perfil', 'href' => '#perfil' ),
			array( 'label' => 'FAQ', 'href' => '#faq' ),
			array( 'label' => 'Contacto', 'href' => '#contacto' ),
		);

		return $this->isDirect() ? array_slice( $links, 0, 2 ) : $links;
	}

	/**
	 * Get Profile Content (Handling lead/detail like legacy)
	 */
	public function getProfileInfo(): array {
		$profile = $this->repo->getProfileSection();
		return array(
			'name'    => $profile->getName(),
			'role'    => $profile->getRole(),
			'lead'    => $profile->getIntroduction(),
			'detail'  => $profile->getHowIWork(),
			'photo'   => $profile->getPhotoUrl(),
			'bullets' => $profile->getBenefits(),
		);
	}
}
