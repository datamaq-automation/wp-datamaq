<?php
namespace DataMaq\Infrastructure\Lead;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Domain\Lead\LeadRepositoryInterface;

/**
 * Implementation of LeadRepository for n8n Webhooks.
 */
class N8nLeadRepository implements LeadRepositoryInterface {
    const DEFAULT_WEBHOOK_URL = 'https://n8n.datamaq.com.ar/webhook/contact-form';

    private string $webhookUrl;

    public function __construct(string $webhookUrl = '') {
        // Fetch from WP Admin settings, fallback to provided or hardcoded
        $this->webhookUrl = $webhookUrl ?: get_option('dm_n8n_webhook_url', self::DEFAULT_WEBHOOK_URL);
    }

    public function save(LeadEntity $lead): bool {
        $data = $lead->toArray();
        $channel = $this->normalizeChannel($data['channel'] ?? 'email');
        
        $payload = [
            'source' => 'datamaq_wp_theme',
            'timestamp' => date('c'),
            'data' => [
                'name' => $lead->getName(),
                'email' => $lead->getEmail(),
                'phone' => $lead->getPhone(),
                'company' => $data['company'] ?? '',
                'message' => $data['message'] ?? '',
                'channel' => $channel,
            ]
        ];

        $response = wp_remote_post($this->webhookUrl, [
            'body' => wp_json_encode($payload),
            'headers' => $this->getHeaders(),
            'timeout' => 15,
            'blocking' => false // Faster UX
        ]);

        if (is_wp_error($response)) {
            error_log('DataMaq n8n lead webhook error: ' . $response->get_error_message());
        }

        return !is_wp_error($response);
    }

    private function getHeaders(): array {
        $headers = ['Content-Type' => 'application/json'];

        if (defined('DATAMAQ_N8N_API_KEY') && trim((string) DATAMAQ_N8N_API_KEY) !== '') {
            $headers['X-API-KEY'] = trim((string) DATAMAQ_N8N_API_KEY);
        }

        return $headers;
    }

    private function normalizeChannel(string $channel): string {
        $channel = strtolower(trim($channel));

        return in_array($channel, ['whatsapp', 'email'], true) ? $channel : 'email';
    }
}
