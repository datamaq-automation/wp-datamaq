<?php
/**
 * Plugin Name: Datamaq Costs
 * Description: Sistema de gestión de costos y presupuestación automatizada para Relevamientos y Automatizaciones.
 * Version: 1.0.0
 * Author: Datamaq
 * Text Domain: datamaq-costs
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Definir constantes del plugin
define( 'DATAMAQ_COSTS_PATH', plugin_dir_path( __FILE__ ) );
define( 'DATAMAQ_COSTS_URL', plugin_dir_url( __FILE__ ) );
define( 'DATAMAQ_COSTS_FILE', __FILE__ );

// Autoloader simple para la estructura src/ (PSR-4 manual)
spl_autoload_register( function ( $class ) {
    $prefix = 'Datamaq\\Costs\\';
    $base_dir = DATAMAQ_COSTS_PATH . 'src/';

    $len = strlen( $prefix );
    if ( strncmp( $prefix, $class, $len ) !== 0 ) {
        return;
    }

    $relative_class = substr( $class, $len );
    $file = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

    if ( file_exists( $file ) ) {
        require $file;
    }
} );

/**
 * Clase Bootstrap para inicializar el plugin
 */
class DatamaqCostsPlugin {
    public static function init() {
        $settingsRepository = new \Datamaq\Costs\Infrastructure\Persistence\WordPressSettingsRepository();

        // Admin
        if ( is_admin() ) {
            new \Datamaq\Costs\Infrastructure\UI\Admin\SettingsPage($settingsRepository);
            new \Datamaq\Costs\Infrastructure\UI\Admin\AjaxHandler();
        }

        // Frontend
        $shortcodeHandler = new \Datamaq\Costs\Infrastructure\UI\Frontend\ShortcodeHandler($settingsRepository);
        $shortcodeHandler->init();

        $frontendAjax = new \Datamaq\Costs\Infrastructure\UI\Frontend\AjaxHandler($settingsRepository);
        $frontendAjax->init();

        // WooCommerce
        $cartHandler = new \Datamaq\Costs\Infrastructure\UI\WooCommerce\CartHandler();
        $cartHandler->init();
    }
}

// Lanzar el plugin
add_action( 'plugins_loaded', [ 'DatamaqCostsPlugin', 'init' ] );
