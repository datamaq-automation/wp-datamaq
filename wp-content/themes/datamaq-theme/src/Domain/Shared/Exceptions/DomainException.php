<?php
namespace DataMaq\Domain\Shared\Exceptions;

class DomainException extends \Exception {
    protected array $errors = [];

    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null, array $errors = []) {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
