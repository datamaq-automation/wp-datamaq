<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for the Hero Section.
 */
class HeroSection {
	private string $eyebrow;
	private string $title;
	private string $subtitle;
	private string $ctaLabel;
	private string $statusInfo;
	private array $trustChips;
	private string $imagePath;

	public function __construct(
		string $eyebrow,
		string $title,
		string $subtitle,
		string $ctaLabel,
		string $statusInfo,
		array $trustChips,
		string $imagePath
	) {
		$this->eyebrow    = $eyebrow;
		$this->title      = $title;
		$this->subtitle   = $subtitle;
		$this->ctaLabel   = $ctaLabel;
		$this->statusInfo = $statusInfo;
		$this->trustChips = $trustChips;
		$this->imagePath  = $imagePath;
	}

	public function getEyebrow(): string {
		return $this->eyebrow; }
	public function getTitle(): string {
		return $this->title; }
	public function getSubtitle(): string {
		return $this->subtitle; }
	public function getCtaLabel(): string {
		return $this->ctaLabel; }
	public function getStatusInfo(): string {
		return $this->statusInfo; }
	public function getTrustChips(): array {
		return $this->trustChips; }
	public function getImagePath(): string {
		return $this->imagePath; }
}
