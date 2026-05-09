<?php

namespace DataMaq\Domain\Shared\Observability;

/**
 * TraceContext (Shared/Observability)
 * 
 * Almacena el contexto de trazabilidad de la petición actual.
 */
class TraceContext {
	private static ?string $traceId = null;

	public static function set( string $id ): void {
		self::$traceId = $id;
	}

	public static function get(): string {
		return self::$traceId ?? 'internal-' . uniqid();
	}

	public static function format( string $message ): string {
		return sprintf( '[%s] %s', self::get(), $message );
	}
}
