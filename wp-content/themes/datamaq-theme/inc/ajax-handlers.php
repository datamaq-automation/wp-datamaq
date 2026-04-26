<?php
/**
 * DataMaq AJAX Handlers - SOLID Refactor
 * Implementa un sistema basado en eventos para desacoplar las integraciones.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// --- 1. CORE DISPATCHER ---

/**
 * Manejador principal de AJAX.
 * Responsabilidad: Solo seguridad y orquestación inicial.
 */
add_action( 'wp_ajax_submit_contact', 'dm_ajax_contact_controller' );
add_action( 'wp_ajax_nopriv_submit_contact', 'dm_ajax_contact_controller' );

function dm_ajax_contact_controller() {
    try {
        // Validación de Seguridad (Nonce)
        if ( ! isset( $_POST['dm_contact_nonce_field'] ) || ! wp_verify_nonce( $_POST['dm_contact_nonce_field'], 'dm_contact_nonce' ) ) {
            throw new Exception( 'Validación de seguridad fallida. Por favor, refresque la página.' );
        }

        // Extracción y Limpieza de datos (DTO Pattern) - Sintaxis compatible PHP 5.6+
        $data = [
            'first_name'        => isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '',
            'last_name'         => isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '',
            'email'             => isset($_POST['email']) ? sanitize_email($_POST['email']) : '',
            'phone'             => isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '',
            'company'           => isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '',
            'message'           => isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '',
            'preferred_channel' => isset($_POST['preferred_channel']) ? sanitize_text_field($_POST['preferred_channel']) : 'whatsapp',
            'source_url'        => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : home_url(),
            'captcha_token'     => isset($_POST['cf-turnstile-response']) ? sanitize_text_field($_POST['cf-turnstile-response']) : ''
        ];

        // Validación de Negocio
        if ( empty( $data['email'] ) || ! is_email( $data['email'] ) ) {
            throw new Exception( 'El email proporcionado no es válido.' );
        }

        /**
         * DISPATCHER: Disparamos el evento de WordPress.
         * Esto permite que CUALQUIER servicio se suscriba sin modificar este código (Open/Closed Principle).
         */
        do_action( 'dm_contact_form_submitted', $data );

        wp_send_json_success([
            'message' => 'Solicitud técnica recibida. Agustín te contactará pronto para coordinar el siguiente paso.'
        ]);

    } catch ( Exception $e ) {
        wp_send_json_error( [ 'message' => $e->getMessage() ] );
    }
}


// --- 2. INTEGRACIONES (Suscriptores) ---

/**
 * Integración A: Correo Electrónico (Legacy Support)
 */
add_action( 'dm_contact_form_submitted', 'dm_integration_email_sender' );

function dm_integration_email_sender( $data ) {
    $to = 'info@datamaq.com.ar';
    $subject = "DataMaq: Nueva Consulta de " . $data['first_name'] . " " . $data['last_name'];
    
    $body = "Nueva consulta técnica recibida desde la web:\n\n";
    $body .= "Nombre: " . $data['first_name'] . " " . $data['last_name'] . "\n";
    $body .= "Empresa: " . $data['company'] . "\n";
    $body .= "Email: " . $data['email'] . "\n";
    $body .= "Teléfono: " . $data['phone'] . "\n";
    $body .= "Mensaje: " . $data['message'] . "\n";
    $body .= "Canal de respuesta preferido: " . $data['preferred_channel'] . "\n";
    $body .= "URL de origen: " . $data['source_url'] . "\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: " . $data['email']
    ];

    wp_mail( $to, $subject, $body, $headers );
}

/**
 * Integración B: Puente con n8n (Modern Support)
 */
add_action( 'dm_contact_form_submitted', 'dm_integration_n8n_bridge' );

function dm_integration_n8n_bridge( $data ) {
    $webhook_url = 'https://n8n.datamaq.com.ar/webhook/contact-form';

    wp_remote_post( $webhook_url, [
        'blocking'    => false,
        'body'        => $data,
        'timeout'     => 10,
        'redirection' => 5,
        'httpversion' => '1.1',
        'sslverify'   => true
    ]);
}
