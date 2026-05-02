<?php
namespace Datamaq\Costs\Infrastructure\Persistence; // Reutilizamos infraestructura o creamos nueva carpeta

use Datamaq\Costs\Domain\Services\ContextServiceInterface;

class WordPressContextService implements ContextServiceInterface {
    
    public function isProductPage(int $productId): bool {
        // En temas Vue/Headless, is_product() a veces falla. 
        // Usamos una detección combinada más agresiva.
        $currentId = $this->getCurrentId();
        
        if ($currentId === $productId) {
            return true;
        }

        // Fallback: Verificar si estamos en la URL del producto si el ID no está disponible aún
        if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'relevamiento-tecnico') !== false) {
            return true;
        }

        return false;
    }

    public function isAdmin(): bool {
        return is_admin();
    }

    public function getCurrentId(): int {
        global $post;
        
        if (is_object($post)) {
            return $post->ID;
        }

        // Si estamos en el loop de WooCommerce
        if (function_exists('get_queried_object_id')) {
            return get_queried_object_id();
        }

        return 0;
    }
}
