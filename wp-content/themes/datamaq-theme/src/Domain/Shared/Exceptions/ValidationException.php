<?php
namespace DataMaq\Domain\Shared\Exceptions;

class ValidationException extends DomainException {
	public function __construct( array $errors = array() ) {
		parent::__construct( 'Error de validación', 422, null, $errors );
	}
}
