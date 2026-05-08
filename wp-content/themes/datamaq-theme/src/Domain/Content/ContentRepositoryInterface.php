<?php
namespace DataMaq\Domain\Content;

interface ContentRepositoryInterface {
	/**
	 * Get all site content data.
	 * @return array
	 */
	public function getAll(): array;

	/**
	 * Get a specific section by key (Legacy Support).
	 * @param string $key
	 * @return array|null
	 */
	public function getSection( string $key ): ?array;

	/**
	 * Get the brand identity information.
	 * @return BrandInfo
	 */
	public function getBrandInfo(): BrandInfo;

	/**
	 * Get the hero section domain model.
	 * @return HeroSection
	 */
	public function getHeroSection(): HeroSection;

	/**
	 * Get the services section domain model.
	 * @return ServicesSection
	 */
	public function getServicesSection(): ServicesSection;

	/**
	 * Get the FAQ section domain model.
	 * @return FaqSection
	 */
	public function getFaqSection(): FaqSection;

	/**
	 * Get the footer section domain model.
	 * @return FooterSection
	 */
	public function getFooterSection(): FooterSection;

	/**
	 * Get the profile section domain model.
	 * @return ProfileSection
	 */
	public function getProfileSection(): ProfileSection;

	/**
	 * Get the standalone contact page domain model.
	 * @return ContactPage
	 */
	public function getFullContactPage(): ContactPage;

	/**
	 * Get the contact section domain model.
	 * @return ContactSection
	 */
	public function getContactSection(): ContactSection;
}
