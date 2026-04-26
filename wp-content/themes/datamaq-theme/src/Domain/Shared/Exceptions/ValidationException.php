<?php
namespace DataMaq\Domain\Shared\Exceptions;

class ValidationException extends DomainException {
    public function __construct(array $errors = []) {
        parent::__construct("Error de validación", 422, null, $errors);
    }
}
