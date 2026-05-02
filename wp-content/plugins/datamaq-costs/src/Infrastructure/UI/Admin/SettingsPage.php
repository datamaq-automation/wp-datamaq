<?php

namespace Datamaq\Costs\Infrastructure\UI\Admin;

/**
 * Gestiona la página de ajustes en el panel de WordPress
 */
class SettingsPage {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    public function add_menu_page() {
        add_menu_page(
            'Datamaq Costs',
            'Datamaq Costs',
            'manage_options',
            'datamaq-costs',
            [ $this, 'render_settings_page' ],
            'dashicons-calculator',
            30
        );
    }

    public function register_settings() {
        register_setting( 'datamaq_costs_group', 'datamaq_costs_google_api_key' );
        register_setting( 'datamaq_costs_group', 'datamaq_costs_origin_address' );
        register_setting( 'datamaq_costs_group', 'datamaq_costs_km_rate' );
        register_setting( 'datamaq_costs_group', 'datamaq_costs_base_fee' );
        register_setting( 'datamaq_costs_group', 'datamaq_costs_engineering_rate' );
        register_setting( 'datamaq_costs_group', 'datamaq_costs_assembly_rate' );
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Ajustes de Datamaq Costs</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'datamaq_costs_group' );
                do_settings_sections( 'datamaq_costs_group' );
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Google Maps API Key</th>
                        <td><input type="text" name="datamaq_costs_google_api_key" value="<?php echo esc_attr( get_option( 'datamaq_costs_google_api_key' ) ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Dirección de Origen (Datamaq)</th>
                        <td><input type="text" name="datamaq_costs_origin_address" value="<?php echo esc_attr( get_option( 'datamaq_costs_origin_address' ) ); ?>" class="regular-text" placeholder="Ej: Av. Siempreviva 742, CABA" /></td>
                    </tr>
                    
                    <tr><td colspan="2"><h3>Tarifas de Relevamiento</h3></td></tr>
                    <tr valign="top">
                        <th scope="row">Tarifa Base ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_base_fee" value="<?php echo esc_attr( get_option( 'datamaq_costs_base_fee' ) ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Valor por KM ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_km_rate" value="<?php echo esc_attr( get_option( 'datamaq_costs_km_rate' ) ); ?>" /></td>
                    </tr>

                    <tr><td colspan="2"><h3>Tarifas de Automatización</h3></td></tr>
                    <tr valign="top">
                        <th scope="row">Valor Hora Ingeniería ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_engineering_rate" value="<?php echo esc_attr( get_option( 'datamaq_costs_engineering_rate' ) ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Valor Hora Montaje ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_assembly_rate" value="<?php echo esc_attr( get_option( 'datamaq_costs_assembly_rate' ) ); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}
