<?php
namespace DataMaq\Domain\Shared\Exceptions;

class DomainException extends \Exception {
	protected array $errors = array();

	public function __construct( string $message = '', int $code = 0, \Throwable $previous = null, array $errors = array() ) {
		parent::__construct( $message, $code, $previous );
		$this->errors = $errors;
	}

	public function getErrors(): array {
		return $this->errors;
	}
}
