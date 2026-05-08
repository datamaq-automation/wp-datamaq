<?php
namespace DataMaq\Domain\Content;

/**
 * Domain model for the standalone Contact Page.
 */
class ContactPage {
	private string $title;
	private string $introCopy;
	private array $supportChannels;
	private array $technician;

	public function __construct( string $title, string $introCopy, array $supportChannels, array $technician ) {
		$this->title           = $title;
		$this->introCopy       = $introCopy;
		$this->supportChannels = $supportChannels;
		$this->technician      = $technician;
	}

	public function getTitle(): string {
		return $this->title; }
	public function getIntroCopy(): string {
		return $this->introCopy; }
	public function getSupportChannels(): array {
		return $this->supportChannels; }

	public function getTechnicianName(): string {
		return $this->technician['name'] ?? 'Agustin Bustos';
	}

	public function getTechnicianAvatar(): string {
		return $this->technician['avatar'] ?? '/media/tecnico-a-cargo.webp';
	}
}
