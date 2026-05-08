<?php
/**
 * DataMaq Admin Settings
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('admin_menu', 'dm_register_settings_menu');
function dm_register_settings_menu() {
    add_options_page(
        'Configuraci&oacute;n de n8n',
        'n8n Integration',
        'manage_options',
        'datamaq-n8n-settings',
        'dm_render_settings_page'
    );
}

add_action('admin_init', 'dm_register_settings_fields');
function dm_register_settings_fields() {
    register_setting('datamaq_settings_group', 'dm_n8n_webhook_url');

    add_settings_section(
        'dm_integrations_section',
        'Integración con n8n Webhooks',
        '__return_empty_string',
        'datamaq-n8n-settings'
    );

    add_settings_field(
        'dm_n8n_webhook_url_field',
        'URL de Webhook n8n',
        'dm_n8n_webhook_url_callback',
        'datamaq-n8n-settings',
        'dm_integrations_section'
    );
}

function dm_n8n_webhook_url_callback() {
    $value = get_option('dm_n8n_webhook_url', 'https://n8n.datamaq.com.ar/webhook/wf_contact_turnstile_telegram/webhookcontact/contact-form');
    echo '<input type="url" name="dm_n8n_webhook_url" value="' . esc_url($value) . '" class="regular-text" placeholder="https://...">';
    echo '<p class="description">La URL del Webhook de n8n donde se enviar&aacute;n los leads del formulario de contacto.</p>';
}

function dm_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configuraci&oacute;n de DataMaq</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('datamaq_settings_group');
            do_settings_sections('datamaq-n8n-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
