<?php
namespace DataMaq\Domain\Shared\Validation;

use DataMaq\Domain\Shared\Exceptions\ValidationException;

class ContentValidator {
	/**
	 * Validate the site content structure.
	 * @throws ValidationException
	 */
	public static function validate( array $data ): void {
		$required_sections = array( 'hero', 'brand', 'services' );
		$missing           = array();

		foreach ( $required_sections as $section ) {
			if ( ! isset( $data[ $section ] ) ) {
				$missing[] = "Falta la sección requerida: $section";
			}
		}

		if ( ! empty( $missing ) ) {
			throw new ValidationException( $missing );
		}

		// Basic hero validation
		if ( isset( $data['hero'] ) && empty( $data['hero']['title'] ) ) {
			throw new ValidationException( array( 'hero.title' => 'El título del Hero no puede estar vacío' ) );
		}
	}
}
