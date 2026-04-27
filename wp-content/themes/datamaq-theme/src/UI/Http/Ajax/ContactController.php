<?php
namespace DataMaq\UI\Http\Ajax;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Application\Lead\SubmitLeadUseCase;
use DataMaq\Infrastructure\Lead\N8nLeadRepository;
use DataMaq\Domain\Shared\Exceptions\ValidationException;
use DataMaq\Domain\Shared\Exceptions\DomainException;

class ContactController {
    public function handleRequest() {
        try {
            check_ajax_referer('datamaq_contact_nonce', 'security');

            // Map frontend fields (prefix dm_) to domain entity
            $name = sanitize_text_field($_POST['dm_name'] ?? '');
            $email = sanitize_email($_POST['dm_email'] ?? 'info@datamaq.com.ar');
            $company = sanitize_text_field($_POST['dm_company'] ?? '');
            $message = sanitize_text_field($_POST['dm_message'] ?? '');
            $channel = sanitize_text_field($_POST['dm_channel'] ?? 'whatsapp');
            $phone = sanitize_text_field($_POST['dm_phone'] ?? '');

            if (empty($name)) {
                throw new ValidationException(['dm_name' => 'El nombre es obligatorio']);
            }

            // Infrastructure Injection
            $repository = new N8nLeadRepository(); 
            $useCase = new SubmitLeadUseCase($repository);
            
            $lead = new LeadEntity($name, $email, $company, $message, $channel, $phone);

            if ($useCase->execute($lead)) {
                wp_send_json_success(['message' => '¡Gracias! Tu consulta ha sido enviada con éxito.']);
            } else {
                throw new DomainException('Error al conectar con el servicio de mensajería');
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
        } catch (\Throwable $e) {
            wp_send_json_error([
                'message' => 'Error crítico: ' . $e->getMessage(),
                'status' => 500
            ]);
        }
    }
}
