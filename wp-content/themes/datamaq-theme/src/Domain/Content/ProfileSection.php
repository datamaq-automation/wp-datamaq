<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for the Profile section.
 * Following DDD principles: Pure data structure.
 */
class ProfileSection {
	private string $name;
	private string $role;
	private string $introduction;
	private string $howIWork;
	private string $photoUrl;
	private array $benefits;
	private string $whatsappLabel;

	public function __construct(
		string $name,
		string $role,
		string $introduction,
		string $howIWork,
		string $photoUrl,
		array $benefits,
		string $whatsappLabel = 'Conversá con nuestro Agente'
	) {
		$this->name          = $name;
		$this->role          = $role;
		$this->introduction  = $introduction;
		$this->howIWork      = $howIWork;
		$this->photoUrl      = $photoUrl;
		$this->benefits      = $benefits;
		$this->whatsappLabel = $whatsappLabel;
	}

	public function getName(): string {
		return $this->name; }
	public function getRole(): string {
		return $this->role; }
	public function getIntroduction(): string {
		return $this->introduction; }
	public function getHowIWork(): string {
		return $this->howIWork; }
	public function getPhotoUrl(): string {
		return $this->photoUrl; }
	public function getBenefits(): array {
		return $this->benefits; }
	public function getWhatsappLabel(): string {
		return $this->whatsappLabel; }
}
