<?php
namespace Datamaq\Costs\Domain\Services;

/**
 * Interfaz para detectar el contexto de ejecución (SaaS/Web)
 */
interface ContextServiceInterface {
    /**
     * ¿Estamos en la página de un producto específico?
     */
    public function isProductPage(int $productId): bool;

    /**
     * ¿Estamos en el panel de administración?
     */
    public function isAdmin(): bool;

    /**
     * Obtener el ID del objeto actual (Post/Producto)
     */
    public function getCurrentId(): int;
}
