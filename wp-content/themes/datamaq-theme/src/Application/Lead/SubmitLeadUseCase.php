<?php
namespace DataMaq\Application\Lead;

use DataMaq\Domain\Lead\LeadEntity;

class SubmitLeadUseCase {
    public function execute(LeadEntity $lead): bool {
        // 1. Send Email
        $to = get_option('admin_email');
        $subject = 'Nuevo Lead: ' . $lead->getName();
        $message = "Nombre: " . $lead->getName() . "\n" .
                   "Email: " . $lead->getEmail() . "\n" .
                   "Empresa: " . $lead->toArray()['company'] . "\n" .
                   "Canal: " . $lead->toArray()['channel'] . "\n\n" .
                   "Mensaje: \n" . $lead->toArray()['message'];
        
        $email_sent = wp_mail($to, $subject, $message);

        // 2. Send to n8n Webhook (Replicating Legacy Behavior)
        $n8n_url = 'https://n8n.datamaq.com.ar/webhook/contact-form';
        $payload = [
            'name' => $lead->getName(),
            'email' => $lead->getEmail(),
            'message' => $lead->toArray()['message'],
            'preferred_contact_channel' => $lead->toArray()['channel'],
            'custom_attributes' => [
                'company' => $lead->toArray()['company']
            ]
        ];

        wp_remote_post($n8n_url, [
            'body' => json_encode($payload),
            'headers' => ['Content-Type' => 'application/json'],
            'timeout' => 15,
            'blocking' => false
        ]);

        return $email_sent;
    }
}
