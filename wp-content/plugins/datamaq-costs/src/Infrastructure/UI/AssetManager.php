<?php
namespace Datamaq\Costs\Infrastructure\UI;

/**
 * Gestiona la carga optimizada de activos (JS/CSS)
 */
class AssetManager {
    
    public function init(): void {
        // Filtro para añadir async/defer a los scripts que lo requieran
        add_filter('script_loader_tag', [$this, 'add_performance_attributes'], 10, 3);
    }

    /**
     * Inyecta atributos async y defer a scripts específicos
     */
    public function add_performance_attributes($tag, $handle, $src): string {
        // Lista de scripts que deben cargarse de forma optimizada
        $optimized_scripts = [
            'google-maps-places' => ['async', 'defer'],
            'datamaq-calculator-js' => ['defer']
        ];

        if (!isset($optimized_scripts[$handle])) {
            return $tag;
        }

        $attributes = $optimized_scripts[$handle];
        $attr_string = implode(' ', $attributes);

        // Insertamos los atributos antes del src
        return str_replace(' src', " {$attr_string} src", $tag);
    }
}
