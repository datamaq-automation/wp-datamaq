<?php
/**
 * DataMaq AJAX Handlers
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_ajax_submit_contact', 'dm_handle_contact_submission' );
add_action( 'wp_ajax_nopriv_submit_contact', 'dm_handle_contact_submission' );

function dm_handle_contact_submission() {
    check_ajax_referer( 'dm_contact_nonce', 'dm_contact_nonce_field' );

    $email = sanitize_email( $_POST['email'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    if ( ! is_email( $email ) || empty( $message ) ) {
        wp_send_json_error( ['message' => 'Email inválido o mensaje vacío.'] );
    }

    $subject = 'DataMaq: Nueva Consulta Técnica';
    $to = 'info@datamaq.com.ar';
    $body = "De: $email\n\nConsulta:\n$message";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: $email"
    ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( ['message' => 'Consulta enviada. Agustín te contactará pronto para coordinar el siguiente paso.'] );
    } else {
        wp_send_json_error( ['message' => 'Error al enviar el email. Por favor, intentá nuevamente o escribinos a info@datamaq.com.ar.'] );
    }
}
