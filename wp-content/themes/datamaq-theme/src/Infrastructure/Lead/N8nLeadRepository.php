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
        // Fetch from WP Admin settings, fallback to provided or hardcoded
        $this->webhookUrl = $webhookUrl ?: get_option('dm_n8n_webhook_url', 'https://n8n.datamaq.com.ar/webhook/contact-form');
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
