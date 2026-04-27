<?php
namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;

/**
 * Implementation of LeadRepository for n8n Webhooks.
 */
class N8nLeadRepository implements LeadRepositoryInterface {
    private string $webhookUrl;

    public function __construct(string $webhookUrl = '') {
        // Fallback to hardcoded for now, but prepared for injection
        $this->webhookUrl = $webhookUrl ?: 'https://n8n.datamaq.com.ar/webhook/contact-form';
    }

    public function save(LeadEntity $lead): bool {
        $data = $lead->toArray();
        
        $payload = [
            'source' => 'datamaq_wp_theme',
            'timestamp' => date('c'),
            'data' => [
                'name' => $lead->getName(),
                'email' => $lead->getEmail(),
                'phone' => $lead->getPhone(),
                'company' => $data['company'] ?? '',
                'message' => $data['message'] ?? '',
                'channel' => $data['channel'] ?? 'email'
            ]
        ];

        $response = wp_remote_post($this->webhookUrl, [
            'body' => json_encode($payload),
            'headers' => ['Content-Type' => 'application/json'],
            'timeout' => 15,
            'blocking' => false // Faster UX
        ]);

        return !is_wp_error($response);
    }
}
