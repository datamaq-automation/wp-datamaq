<?php
namespace DataMaq\UI\Http\Ajax;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Application\Lead\SubmitLeadUseCase;

class ContactController {
    public function handleRequest() {
        check_ajax_referer('datamaq_contact_nonce', 'security');

        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $company = sanitize_text_field($_POST['company']);
        $message = sanitize_textarea_field($_POST['message']);
        $channel = sanitize_text_field($_POST['channel']);

        if (empty($name) || empty($email)) {
            wp_send_json_error(['message' => 'Faltan campos obligatorios']);
        }

        $lead = new LeadEntity($name, $email, $company, $message, $channel);
        $useCase = new SubmitLeadUseCase();

        if ($useCase->execute($lead)) {
            wp_send_json_success(['message' => 'Enviado correctamente']);
        } else {
            wp_send_json_error(['message' => 'Error al enviar']);
        }
    }
}
