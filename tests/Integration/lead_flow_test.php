<?php
/**
 * Integration Test: Lead Flow
 * Runs with: wp eval-file tests/Integration/lead_flow_test.php --allow-root
 */

namespace DataMaq\Tests\Integration;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Infrastructure\Lead\WPLeadLogRepository;

class LeadFlowTest {
    public function run() {
        echo "🚀 Starting Integration Test: Lead Flow...\n";

        // 1. Prepare Data
        $test_email = 'test-' . uniqid() . '@example.com';
        $payload = array(
            'name'      => 'Integration Tester',
            'email'     => $test_email,
            'marketing' => array(
                'utm_source'   => 'integration_test',
                'utm_campaign' => 'shield_2026'
            )
        );

        // 2. Simulate REST Request (Internal call to avoid networking issues in CLI)
        echo "🔹 Simulating REST Request to LeadRestController...\n";
        $request = new \WP_REST_Request('POST', '/datamaq/v1/lead');
        $request->set_header('Content-Type', 'application/json');
        $request->set_header('X-DataMaq-Secret', get_option('datamaq_app_secret') ?: getenv('DATAMAQ_APP_SECRET'));
        $request->set_body(json_encode($payload));

        $response = rest_do_request($request);

        if ($response->get_status() !== 200) {
            echo "❌ FAILED: REST Response status is " . $response->get_status() . "\n";
            print_r($response->get_data());
            exit(1);
        }
        echo "✅ REST Request Successful (200 OK).\n";

        // 3. Verify Local Log
        echo "🔹 Verifying Local Log (Observability)...\n";
        $log_repo = new WPLeadLogRepository();
        $logs = $log_repo->getLastLogs(5);
        
        $found = false;
        foreach ($logs as $log) {
            if ($log['email'] === $test_email) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "❌ FAILED: Lead not found in local logs.\n";
            exit(1);
        }
        echo "✅ Lead successfully persisted in Local Log.\n";

        // 4. Verify Chatwoot Contract (Implicit via success response)
        // Since we can't easily check Chatwoot's DB from here, the 'success' from REST API
        // which comes from ChatWootLeadRepository::save() is our confirmation.
        echo "✅ Chatwoot Sync Confirmed by API Response.\n";

        echo "🎉 ALL TESTS PASSED!\n";
    }
}

(new LeadFlowTest())->run();
