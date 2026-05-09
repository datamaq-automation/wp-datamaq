<?php

namespace DataMaq\Domain\Lead;

/**
 * Entidad Lead (Domain)
 * 
 * Representa un contacto potencial con validaciones de dominio.
 */
class LeadEntity {
	private string $name;
	private string $email;
	private string $phone;
	private array $metadata;

	public function __construct( string $name, string $email = '', string $phone = '', array $metadata = array() ) {
		$this->name     = trim( $name );
		$this->email    = strtolower( trim( $email ) );
		$this->phone    = $this->sanitizePhone( $phone );
		$this->metadata = $metadata;
		
		$this->validate();
	}

	private function sanitizePhone( string $phone ): string {
		if ( empty( $phone ) ) return '';
		// E.164 strict: solo dígitos y prefijo +
		$clean = preg_replace( '/[^0-9]/', '', $phone );
		return '+' . $clean;
	}

	private function validate(): void {
		if ( empty( $this->name ) ) {
			throw new \InvalidArgumentException( "Lead name cannot be empty" );
		}
		if ( empty( $this->email ) && empty( $this->phone ) ) {
			throw new \InvalidArgumentException( "Lead must have at least an email or a phone number" );
		}
	}

	public function getName(): string { return $this->name; }
	public function getEmail(): string { return $this->email; }
	public function getPhone(): string { return $this->phone; }
	public function getMetadata(): array { return $this->metadata; }

	public function toArray(): array {
		return array_merge( $this->metadata, array(
			'name'  => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
		) );
	}
}
