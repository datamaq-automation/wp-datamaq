<?php

namespace DataMaq\Domain\Communication;

/**
 * Interface ChatProvider
 * 
 * Define el contrato para cualquier proveedor de chat (Chatwoot, Botman, etc.)
 */
interface ChatProvider {
    /**
     * Devuelve el identificador único del proveedor.
     */
    public function getIdentifier(): string;

    /**
     * Renderiza los scripts y estilos necesarios en el frontend.
     */
    public function renderWidget(): void;

    /**
     * Indica si el proveedor está habilitado según la configuración.
     */
    public function isEnabled(): bool;
}
