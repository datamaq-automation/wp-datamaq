<?php

/**
 * Script de prueba para conexión con SuiteCRM v8.
 * Ejecutar desde consola: php test-suitecrm.php
 */

// Función simple para leer .env en un script suelto
$env_path = __DIR__ . '/../.env';
if (file_exists($env_path)) {
    $lines = file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
} else {
    die("❌ Error: No se encontró el archivo .env\n");
}

$base_url      = getenv('SUITECRM_BASE_URL');
$client_id     = getenv('SUITECRM_CLIENT_ID');
$client_secret = getenv('SUITECRM_CLIENT_SECRET');
$username      = getenv('SUITECRM_USERNAME');
$password      = getenv('SUITECRM_PASSWORD');

// Validando carga
echo "====================================\n";
echo "🔐 VALIDANDO ENTORNO (.env)\n";
echo "====================================\n";
echo "URL: " . $base_url . "\n";
echo "CLIENT_ID: " . $client_id . "\n";
echo "USERNAME: " . $username . "\n";
echo "PASSWORD: " . (empty($password) ? "[VACIO - POR FAVOR COMPLETA EL .env]" : "********") . "\n";
echo "====================================\n\n";

if (empty($password)) {
    die("❌ Error: Falta SUITECRM_PASSWORD en el .env\n");
}

echo "Iniciando prueba de conexión a SuiteCRM (Modo Password Grant)...\n";
echo "Paso 1: Solicitando Access Token...\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $base_url . '/Api/access_token');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Activar depuración completa
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_HEADER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/vnd.api+json',
    'Accept: application/vnd.api+json'
]);

// Payload JSON:API para OAuth2 (Password Grant)
$payload = json_encode([
    'grant_type' => 'password',
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'username' => $username,
    'password' => $password
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response_raw = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response_raw, 0, $header_size);
$body = substr($response_raw, $header_size);
curl_close($ch);

echo "\n--- RAW HEADERS (Token) ---\n" . $header . "--------------------------\n";

if ($httpcode >= 200 && $httpcode < 300) {
    echo "✅ ÉXITO: Token obtenido correctamente.\n";
    $data = json_decode($body, true);
    $access_token = $data['access_token'] ?? null;
    
    if ($access_token) {
        echo "Token: " . substr($access_token, 0, 15) . "... [Oculto por seguridad]\n\n";
        
        echo "Paso 2: Creando Lead de prueba...\n";
        
        $lead_payload = json_encode([
            "data" => [
                "type" => "Leads",
                "attributes" => [
                    "first_name" => "Prueba BotMan",
                    "last_name" => "DataMaq API (Password Grant)",
                    "phone_work" => "+54110000000",
                    "description" => "Lead generado con Auth de Usuario"
                ]
            ]
        ]);

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $base_url . '/Api/V8/module');
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_VERBOSE, true);
        curl_setopt($ch2, CURLOPT_HEADER, true);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $lead_payload);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            'Content-Type: application/vnd.api+json',
            'Accept: application/vnd.api+json',
            'Authorization: Bearer ' . $access_token
        ]);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);

        $res2_raw = curl_exec($ch2);
        $code2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        $h_size2 = curl_getinfo($ch2, CURLINFO_HEADER_SIZE);
        $h2 = substr($res2_raw, 0, $h_size2);
        $b2 = substr($res2_raw, $h_size2);
        curl_close($ch2);

        echo "\n--- RAW HEADERS (Lead) ---\n" . $h2 . "--------------------------\n";
        echo "HTTP Status Code (Crear Lead): $code2\n";
        
        if ($code2 == 201) {
            echo "✅ ÉXITO TOTAL: Lead creado en SuiteCRM.\n";
            print_r(json_decode($b2, true));
        } else {
            echo "❌ ERROR AL CREAR LEAD. Respuesta del Body:\n";
            echo $b2 . "\n";
        }
        
    }
} else {
    echo "❌ ERROR AL OBTENER TOKEN. Respuesta del Body:\n";
    echo $body . "\n";
}
