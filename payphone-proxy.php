<?php

require_once __DIR__ . '/config.php';

// ── CREDENCIALES PAYPHONE ────────────────────────────────────────────────
define('PP_TOKEN', PAYPHONE_TOKEN);
define('PP_STORE_ID', PAYPHONE_STORE_ID);

// ── ENDPOINTS PAYPHONE ───────────────────────────────────────────────────
define('PP_PREPARE_URL', PAYPHONE_PREPARE_URL);
define('PP_CONFIRM_URL', PAYPHONE_CONFIRM_URL);

// ── URL BASE DE TU PROYECTO (Autodetectada dinámicamente si está vacía o es localhost)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$detectedBase = $protocol . ($_SERVER['HTTP_HOST'] ?? 'localhost:8080');
define('BASE_URL', (PAYPHONE_BASE_URL === '' || str_contains(PAYPHONE_BASE_URL, 'localhost')) ? $detectedBase : PAYPHONE_BASE_URL);


// ── CABECERAS DE RESPUESTA ───────────────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Responder pre-flight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ── ROUTER ───────────────────────────────────────────────────────────────
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'prepare':
        handlePrepare();
        break;
    case 'confirm':
        handleConfirm();
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acción no reconocida. Usa ?action=prepare o ?action=confirm']);
        break;
}

// ─────────────────────────────────────────────────────────────────────────
// PREPARE — Inicia la transacción y obtiene URL del formulario PayPhone
// ─────────────────────────────────────────────────────────────────────────
function handlePrepare() {
    $configError = validatePayPhoneConfig();
    if ($configError !== null) {
        http_response_code(500);
        echo json_encode($configError);
        return;
    }

    // Leer el body JSON enviado por index.html
    $rawBody = file_get_contents('php://input');
    $data    = json_decode($rawBody, true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(['error' => 'Body JSON inválido o vacío']);
        return;
    }

    // Agregar campos obligatorios que gestiona el backend
    $data['storeId']         = PP_STORE_ID;
    $data['responseUrl']     = BASE_URL . '/response.php';
    $data['cancellationUrl'] = BASE_URL . '/index.html';

    // Llamar a PayPhone /button/Prepare
    $result = callPayPhone(PP_PREPARE_URL, $data);

    // Devolver la respuesta tal cual al frontend
    http_response_code($result['httpCode']);
    echo json_encode($result['body']);
}

// ─────────────────────────────────────────────────────────────────────────
// CONFIRM — Verifica el resultado luego de que el usuario pagó
// ─────────────────────────────────────────────────────────────────────────
function handleConfirm() {
    $configError = validatePayPhoneConfig();
    if ($configError !== null) {
        http_response_code(500);
        echo json_encode($configError);
        return;
    }

    $rawBody = file_get_contents('php://input');
    $data    = json_decode($rawBody, true);

    // También acepta parámetros GET (para llamadas desde response.php)
    if (!$data) {
        $data = [
            'id'       => intval($_GET['id']       ?? 0),
            'clientTxId' => $_GET['clientTransactionId'] ?? ''
        ];
    }

    if (empty($data['id']) || empty($data['clientTxId'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Se requieren los campos id y clientTxId']);
        return;
    }

    // id debe ser entero
    $data['id'] = intval($data['id']);

    $result = callPayPhone(PP_CONFIRM_URL, $data);

    http_response_code($result['httpCode']);
    echo json_encode($result['body']);
}

// ─────────────────────────────────────────────────────────────────────────
// HELPER — Llamada cURL a la API de PayPhone
// ─────────────────────────────────────────────────────────────────────────
function callPayPhone(string $url, array $payload): array {
    $jsonPayload = json_encode($payload);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $jsonPayload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . PP_TOKEN,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonPayload),
        ],
    ]);

    $responseRaw  = curl_exec($ch);
    $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError    = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return [
            'httpCode' => 500,
            'body'     => ['error' => 'Error cURL: ' . $curlError]
        ];
    }

    $body = json_decode($responseRaw, true);
    if ($body === null) {
        $body = ['rawResponse' => $responseRaw];
    }

    return [
        'httpCode' => $httpCode,
        'body'     => $body
    ];
}
