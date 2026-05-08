<?php

namespace DataMaq\Domain\Shared\Health;

/**
 * Value Object que representa el estado de salud de un servicio.
 */
class HealthStatus {

	private string $status;
	private string $message;
	private float $latency;
	private \DateTimeImmutable $checkedAt;

	public function __construct( string $status, string $message, float $latency ) {
		$this->status    = $status;
		$this->message   = $message;
		$this->latency   = $latency;
		$this->checkedAt = new \DateTimeImmutable();
	}

	public function getStatus(): string {
		return $this->status;
	}

	public function getMessage(): string {
		return $this->message;
	}

	public function getLatency(): float {
		return $this->latency;
	}

	public function isOperational(): bool {
		return 'ok' === $this->status;
	}

	public function toArray(): array {
		return array(
			'status'     => $this->status,
			'message'    => $this->message,
			'latency'    => $this->latency,
			'checked_at' => $this->checkedAt->format( \DateTimeInterface::ATOM ),
		);
	}
}
