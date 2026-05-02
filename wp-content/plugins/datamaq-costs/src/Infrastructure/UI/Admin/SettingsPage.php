<?php

namespace Datamaq\Costs\Infrastructure\UI\Admin;

use Datamaq\Costs\Domain\Repository\SettingsRepositoryInterface;

/**
 * Gestiona la página de ajustes en el panel de WordPress
 */
class SettingsPage {

    private SettingsRepositoryInterface $repository;

    public function __construct(SettingsRepositoryInterface $repository) {
        $this->repository = $repository;
        add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function enqueue_assets($hook) {
        if ('toplevel_page_datamaq-costs' !== $hook) {
            return;
        }

        wp_enqueue_style('datamaq-costs-admin', DATAMAQ_COSTS_URL . 'assets/css/admin-settings.css', [], '1.0.0');
        wp_enqueue_script('datamaq-costs-admin', DATAMAQ_COSTS_URL . 'assets/js/admin-settings.js', ['jquery'], '1.0.0', true);
        
        wp_localize_script('datamaq-costs-admin', 'datamaq_costs_params', [
            'nonce' => wp_create_nonce('datamaq_costs_admin')
        ]);
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
        $settings = $this->repository->getSettings();
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
                        <td>
                            <div class="datamaq-api-key-container">
                                <input type="text" name="datamaq_costs_google_api_key" value="<?php echo esc_attr( $settings->getGoogleApiKey() ); ?>" class="regular-text" />
                                <button type="button" id="datamaq-test-google-key" class="button button-secondary">Probar API Key</button>
                            </div>
                            <span id="datamaq-google-key-feedback"></span>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Dirección de Origen (Datamaq)</th>
                        <td><input type="text" name="datamaq_costs_origin_address" value="<?php echo esc_attr( $settings->getOriginAddress() ); ?>" class="regular-text" placeholder="Ej: Av. Siempreviva 742, CABA" /></td>
                    </tr>
                    
                    <tr><td colspan="2"><h3>Tarifas de Relevamiento</h3></td></tr>
                    <tr valign="top">
                        <th scope="row">Tarifa Base ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_base_fee" value="<?php echo esc_attr( $settings->getBaseFee() ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Valor por KM ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_km_rate" value="<?php echo esc_attr( $settings->getKmRate() ); ?>" /></td>
                    </tr>

                    <tr><td colspan="2"><h3>Tarifas de Automatización</h3></td></tr>
                    <tr valign="top">
                        <th scope="row">Valor Hora Ingeniería ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_engineering_rate" value="<?php echo esc_attr( $settings->getEngineeringRate() ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Valor Hora Montaje ($)</th>
                        <td><input type="number" step="0.01" name="datamaq_costs_assembly_rate" value="<?php echo esc_attr( $settings->getAssemblyRate() ); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}
