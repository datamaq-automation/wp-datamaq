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
        register_setting( 'datamaq_costs_group', 'datamaq_costs_chatwoot_enabled' );
    }

    public function render_settings_page() {
        $settings = $this->repository->getSettings();
        $apiKey = $settings->getGoogleApiKey()->getValue();
        $maskedKey = !empty($apiKey) ? substr($apiKey, 0, 4) . '...' . substr($apiKey, -4) : '';
        ?>
        <div class="wrap datamaq-costs-admin">
            <div class="datamaq-admin-header">
                <h1><span class="dashicons dashicons-calculator"></span> <?php echo esc_html(get_admin_page_title()); ?></h1>
                
                <div class="edit-mode-container">
                    <label class="switch">
                        <input type="checkbox" id="datamaq-edit-mode">
                        <span class="slider round"></span>
                    </label>
                    <span class="edit-mode-label">Modo Edición</span>
                </div>
            </div>
            
            <form method="post" action="options.php" class="datamaq-settings-form is-read-only">
                <?php
                settings_fields('datamaq_costs_group');
                ?>

                <div class="datamaq-card">
                    <div class="datamaq-card-header">
                        <h2><span class="dashicons dashicons-admin-network"></span> Conectividad Google Maps</h2>
                    </div>
                    <div class="datamaq-card-body">
                        <table class="form-table" role="presentation">
                            <tr>
                                <th scope="row"><label for="datamaq_costs_google_api_key">Google API Key</label></th>
                                <td>
                                    <div class="api-key-container">
                                        <input type="password" 
                                               id="datamaq_costs_google_api_key" 
                                               name="datamaq_costs_google_api_key" 
                                               value="<?php echo esc_attr($apiKey); ?>" 
                                               class="regular-text" 
                                               autocomplete="off">
                                        <button type="button" class="button button-secondary toggle-visibility" title="Mostrar/Ocultar">
                                            <span class="dashicons dashicons-visibility"></span>
                                        </button>
                                        <button type="button" id="test-google-key" class="button button-secondary">
                                            <span class="spinner-container"></span>
                                            Probar Conexión
                                        </button>
                                    </div>
                                    <p class="description">Necesaria para el cálculo de distancias. Truncado actual: <code><?php echo esc_html($maskedKey); ?></code></p>
                                    <div id="test-result-container"></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="datamaq_costs_origin_address">Dirección de Origen</label></th>
                                <td>
                                    <input type="text" id="datamaq_costs_origin_address" name="datamaq_costs_origin_address" value="<?php echo esc_attr($settings->getOriginAddress()); ?>" class="regular-text" placeholder="Ej: Av. Cabildo 2000, CABA">
                                    <p class="description">Punto de partida para el cálculo de viáticos.</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="datamaq-card">
                    <div class="datamaq-card-header">
                        <h2><span class="dashicons dashicons-chart-area"></span> Tarifas de Costos</h2>
                    </div>
                    <div class="datamaq-card-body">
                        <table class="form-table" role="presentation">
                            <tr>
                                <th scope="row"><label for="datamaq_costs_base_fee">Tarifa Base (Bajada de Bandera)</label></th>
                                <td>
                                    <span class="currency-prefix">$</span>
                                    <input type="number" step="0.01" id="datamaq_costs_base_fee" name="datamaq_costs_base_fee" value="<?php echo esc_attr($settings->getBaseFee()->getAmount()); ?>" class="small-text">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="datamaq_costs_km_rate">Precio por Kilómetro</label></th>
                                <td>
                                    <span class="currency-prefix">$</span>
                                    <input type="number" step="0.01" id="datamaq_costs_km_rate" name="datamaq_costs_km_rate" value="<?php echo esc_attr($settings->getKmRate()->getAmount()); ?>" class="small-text">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="datamaq_costs_engineering_rate">Hora de Ingeniería</label></th>
                                <td>
                                    <span class="currency-prefix">$</span>
                                    <input type="number" step="0.01" id="datamaq_costs_engineering_rate" name="datamaq_costs_engineering_rate" value="<?php echo esc_attr($settings->getEngineeringRate()->getAmount()); ?>" class="small-text">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="datamaq_costs_assembly_rate">Hora de Montaje</label></th>
                                <td>
                                    <span class="currency-prefix">$</span>
                                    <input type="number" step="0.01" id="datamaq_costs_assembly_rate" name="datamaq_costs_assembly_rate" value="<?php echo esc_attr($settings->getAssemblyRate()->getAmount()); ?>" class="small-text">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="datamaq-card">
                    <div class="datamaq-card-header">
                        <h2><span class="dashicons dashicons-format-chat"></span> Servicios Externos</h2>
                    </div>
                    <div class="datamaq-card-body">
                        <table class="form-table" role="presentation">
                            <tr>
                                <th scope="row"><label for="datamaq_costs_chatwoot_enabled">Habilitar Chatwoot</label></th>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" 
                                               id="datamaq_costs_chatwoot_enabled" 
                                               name="datamaq_costs_chatwoot_enabled" 
                                               value="1" 
                                               <?php checked($settings->isChatwootEnabled(), true); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                    <p class="description">Si se desactiva, el widget de chat no se cargará en el frontend (evita errores de conexión si el servidor está caído).</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php submit_button('Guardar Cambios Profundos', 'primary large'); ?>
            </form>
        </div>
        <?php
    }
}
