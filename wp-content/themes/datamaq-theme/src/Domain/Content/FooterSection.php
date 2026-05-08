<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for the Footer Section.
 */
class FooterSection {
	private string $copyrightNote;
	private string $legalText;
	private string $whatsappUrl;

	public function __construct( string $copyrightNote, string $legalText, string $whatsappUrl ) {
		$this->copyrightNote = $copyrightNote;
		$this->legalText     = $legalText;
		$this->whatsappUrl   = $whatsappUrl;
	}

	public function getCopyrightNote(): string {
		// Reemplazar marcador de posición de año si existe
		return str_replace( '{year}', date( 'Y' ), $this->copyrightNote );
	}

	public function getLegalText(): string {
		return $this->legalText; }
	public function getWhatsappUrl(): string {
		return $this->whatsappUrl; }
}
