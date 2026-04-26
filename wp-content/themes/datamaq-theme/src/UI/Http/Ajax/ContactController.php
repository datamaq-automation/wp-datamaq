<?php
namespace DataMaq\UI\Http\Ajax;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Application\Lead\SubmitLeadUseCase;
use DataMaq\Domain\Shared\Exceptions\ValidationException;
use DataMaq\Domain\Shared\Exceptions\DomainException;

class ContactController {
    public function handleRequest() {
        try {
            check_ajax_referer('datamaq_contact_nonce', 'security');

            $name = sanitize_text_field($_POST['name'] ?? '');
            $email = sanitize_email($_POST['email'] ?? '');
            $company = sanitize_text_field($_POST['company'] ?? '');
            $message = sanitize_textarea_field($_POST['message'] ?? '');
            $channel = sanitize_text_field($_POST['channel'] ?? '');

            if (empty($name) || empty($email)) {
                throw new ValidationException(['fields' => 'Nombre y email son obligatorios']);
            }

            $lead = new LeadEntity($name, $email, $company, $message, $channel);
            $useCase = new SubmitLeadUseCase();

            if ($useCase->execute($lead)) {
                wp_send_json_success(['message' => '¡Gracias! Nos pondremos en contacto pronto.']);
            } else {
                throw new DomainException('Error interno al procesar el lead');
            }

        } catch (ValidationException $e) {
            wp_send_json_error([
                'message' => $e->getMessage(),
                'errors' => $e->getErrors(),
                'status' => 422
            ]);
        } catch (DomainException $e) {
            wp_send_json_error([
                'message' => $e->getMessage(),
                'status' => 500
            ]);
        } catch (\Exception $e) {
            wp_send_json_error([
                'message' => 'Ocurrió un error inesperado',
                'status' => 500
            ]);
        }
    }
}
