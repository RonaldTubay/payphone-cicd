<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resultado del Pago — TechStore</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap');

    :root {
      --bg: #0f0f13;
      --surface: #18181f;
      --card: #1e1e28;
      --border: #2a2a38;
      --accent: #5b6af7;
      --accent2: #7c8bff;
      --green: #22c55e;
      --red: #ef4444;
      --yellow: #f59e0b;
      --text: #e8e8f0;
      --muted: #8888aa;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 2.5rem 2rem;
      width: 100%;
      max-width: 520px;
    }

    .status-icon { font-size: 4rem; text-align: center; margin-bottom: 1rem; }
    .status-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.6rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 0.5rem;
    }
    .status-subtitle {
      color: var(--muted);
      font-size: 0.9rem;
      text-align: center;
      margin-bottom: 2rem;
    }

    .info-box {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1rem 1.2rem;
      margin-bottom: 1rem;
    }
    .info-box-title {
      font-size: 0.72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--muted);
      margin-bottom: 0.7rem;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 0.3rem 0;
      border-bottom: 1px solid var(--border);
      font-size: 0.85rem;
      gap: 1rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-key { color: var(--muted); flex-shrink: 0; }
    .info-val { font-weight: 500; text-align: right; word-break: break-all; }
    .info-val.green { color: var(--green); }
    .info-val.red   { color: var(--red); }
    .info-val.yellow{ color: var(--yellow); }
    .info-val.blue  { color: var(--accent2); }

    .json-block {
      background: #0d0d15;
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 1rem;
      font-family: 'Courier New', monospace;
      font-size: 0.75rem;
      line-height: 1.6;
      overflow-x: auto;
      white-space: pre;
      color: #a0a0d0;
      margin-bottom: 1.2rem;
    }
    .json-key  { color: #7c8bff; }
    .json-str  { color: #68d391; }
    .json-num  { color: #f6ad55; }
    .json-bool { color: #fc8181; }

    .btn {
      display: block;
      width: 100%;
      text-align: center;
      padding: 0.85rem;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      border: none;
      text-decoration: none;
      transition: opacity .2s;
      margin-bottom: 0.8rem;
    }
    .btn:hover { opacity: 0.85; }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-ghost   { background: var(--card); color: var(--text); border: 1px solid var(--border); }

    .badge {
      display: inline-block;
      font-size: 0.7rem; font-weight: 700;
      padding: 3px 10px; border-radius: 999px;
    }
    .badge-approved { background: #052e16; color: var(--green); border: 1px solid #166534; }
    .badge-canceled { background: #2d0b0b; color: var(--red);   border: 1px solid #7f1d1d; }
    .badge-pending  { background: #1a1a2e; color: #aaaaff;      border: 1px solid #3333aa; }

    .spinner {
      width: 48px; height: 48px;
      border: 4px solid var(--border);
      border-top-color: var(--accent2);
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      margin: 0 auto 1.5rem;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    #loading-section { text-align: center; }
    #result-section  { display: none; }
  </style>
</head>
<body>
<div class="card">

  <!-- ── CARGANDO ── -->
  <div id="loading-section">
    <div class="spinner"></div>
    <p style="color:var(--muted);font-size:0.95rem">Confirmando tu pago con PayPhone...</p>
    <p style="color:var(--muted);font-size:0.78rem;margin-top:0.5rem;font-family:monospace" id="loading-detail">
      Llamando a /api/button/V2/Confirm...
    </p>
  </div>

  <!-- ── RESULTADO ── -->
  <div id="result-section">
    <div class="status-icon" id="res-icon"></div>
    <div class="status-title" id="res-title"></div>
    <div class="status-subtitle" id="res-subtitle"></div>

    <div style="text-align:center;margin-bottom:1.5rem">
      <span class="badge" id="res-badge"></span>
    </div>

    <!-- Parámetros recibidos de PayPhone (URL) -->
    <div class="info-box">
      <div class="info-box-title">📥 Parámetros recibidos de PayPhone</div>
      <div class="info-row">
        <span class="info-key">id (PayPhone)</span>
        <span class="info-val blue" id="pp-id">—</span>
      </div>
      <div class="info-row">
        <span class="info-key">clientTransactionId</span>
        <span class="info-val" id="pp-ctxid">—</span>
      </div>
    </div>

    <!-- Respuesta de /V2/Confirm -->
    <div class="info-box" id="confirm-box">
      <div class="info-box-title">✅ Respuesta de /button/V2/Confirm</div>
      <div id="confirm-rows"></div>
    </div>

    <!-- JSON completo -->
    <div class="info-box">
      <div class="info-box-title">🔍 JSON Response completo</div>
      <div class="json-block" id="json-block"></div>
    </div>

    <a class="btn btn-primary" href="index.html">🏠 Volver a la tienda</a>
  </div>

</div>

<?php

require_once __DIR__ . '/config.php';


$ppId             = intval($_GET['id']                   ?? 0);
$clientTxId       = trim($_GET['clientTransactionId']    ?? '');

// Llamar a Confirm solo si tenemos los parámetros
$confirmResult = null;
$confirmError  = null;
$httpStatus    = null;

if ($ppId > 0 && $clientTxId !== '') {
    $configError = validatePayPhoneConfig();

    if ($configError !== null) {
        $confirmError = 'Faltan variables de entorno: ' . implode(', ', $configError['missing']);
    } else {
    $payload  = json_encode(['id' => $ppId, 'clientTxId' => $clientTxId]);

    $ch = curl_init(PAYPHONE_CONFIRM_URL);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . PAYPHONE_TOKEN,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
        ],
    ]);

    $raw        = curl_exec($ch);
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr    = curl_error($ch);
    curl_close($ch);

    if ($curlErr) {
        $confirmError = 'Error cURL: ' . $curlErr;
    } else {
        $confirmResult = json_decode($raw, true) ?? ['rawResponse' => $raw];
    }
    }
} else {
    $confirmError = 'Parámetros id o clientTransactionId ausentes en la URL.';
}

// Pasar datos a JavaScript de forma segura
$jsData = json_encode([
    'ppId'          => $ppId,
    'clientTxId'    => $clientTxId,
    'confirmResult' => $confirmResult,
    'confirmError'  => $confirmError,
    'httpStatus'    => $httpStatus,
]);
?>

<script>
// ── Datos del servidor PHP ───────────────────────────────────────────────
const SERVER_DATA = <?= $jsData ?>;

// ── Renderizar resultado ─────────────────────────────────────────────────
(function() {
  const { ppId, clientTxId, confirmResult, confirmError, httpStatus } = SERVER_DATA;

  document.getElementById('pp-id').textContent    = ppId || '(no recibido)';
  document.getElementById('pp-ctxid').textContent = clientTxId || '(no recibido)';

  // Ocultar loading, mostrar resultado
  document.getElementById('loading-section').style.display = 'none';
  document.getElementById('result-section').style.display  = 'block';

  if (confirmError) {
    // Error de red o parámetros faltantes
    document.getElementById('res-icon').textContent    = '⚠️';
    document.getElementById('res-title').textContent   = 'Error al confirmar';
    document.getElementById('res-subtitle').textContent = confirmError;
    document.getElementById('res-badge').textContent   = 'ERROR';
    document.getElementById('res-badge').className     = 'badge badge-canceled';
    document.getElementById('confirm-rows').innerHTML  =
      `<div class="info-row"><span class="info-key">Detalle</span><span class="info-val red">${confirmError}</span></div>`;
    document.getElementById('json-block').textContent  = JSON.stringify({ error: confirmError }, null, 2);
    return;
  }

  const r        = confirmResult || {};
  const sc       = r.statusCode ?? r.StatusCode;
  const approved = sc === 3 || r.transactionStatus === 'Approved';
  const canceled = sc === 2 || r.transactionStatus === 'Canceled';

  // Ícono y título
  if (approved) {
    document.getElementById('res-icon').textContent     = '✅';
    document.getElementById('res-title').textContent    = '¡Pago aprobado!';
    document.getElementById('res-subtitle').textContent = 'Tu transacción fue procesada exitosamente.';
    document.getElementById('res-badge').textContent    = 'APROBADO';
    document.getElementById('res-badge').className      = 'badge badge-approved';
  } else if (canceled) {
    document.getElementById('res-icon').textContent     = '❌';
    document.getElementById('res-title').textContent    = 'Pago cancelado';
    document.getElementById('res-subtitle').textContent = 'La transacción fue cancelada o rechazada.';
    document.getElementById('res-badge').textContent    = 'CANCELADO';
    document.getElementById('res-badge').className      = 'badge badge-canceled';
  } else {
    document.getElementById('res-icon').textContent     = '🕐';
    document.getElementById('res-title').textContent    = 'Estado pendiente';
    document.getElementById('res-subtitle').textContent = r.message || 'No se pudo determinar el estado.';
    document.getElementById('res-badge').textContent    = 'PENDIENTE';
    document.getElementById('res-badge').className      = 'badge badge-pending';
  }

  // Filas de detalle
  const rows = [
    { k: 'transactionId',      v: r.transactionId      ?? 'N/A',  cls: approved ? 'green' : '' },
    { k: 'clientTransactionId',v: r.clientTransactionId ?? clientTxId },
    { k: 'transactionStatus',  v: r.transactionStatus  ?? '—',    cls: approved ? 'green' : 'red' },
    { k: 'statusCode',         v: r.statusCode         ?? '—' },
    { k: 'authorizationCode',  v: r.authorizationCode  ?? 'N/A',  cls: 'blue' },
    { k: 'amount',             v: r.amount ? '$' + (r.amount / 100).toFixed(2) : '—' },
    { k: 'currency',           v: r.currency           ?? '—' },
    { k: 'cardBrand',          v: r.cardBrand          ?? '—' },
    { k: 'lastDigits',         v: r.lastDigits         ?? '—' },
    { k: 'email',              v: r.email              ?? '—' },
    { k: 'message',            v: r.message            ?? '—' },
    { k: 'HTTP Status',        v: httpStatus           ?? '—' },
  ];

  document.getElementById('confirm-rows').innerHTML = rows.map(row =>
    `<div class="info-row">
       <span class="info-key">${row.k}</span>
       <span class="info-val ${row.cls || ''}">${row.v}</span>
     </div>`
  ).join('');

  // JSON completo con syntax highlight
  document.getElementById('json-block').innerHTML = syntaxHighlight(
    JSON.stringify(confirmResult, null, 2)
  );
})();

function syntaxHighlight(json) {
  if (!json) return '{}';
  return json
    .replace(/(".*?"):/g,   '<span class="json-key">$1</span>:')
    .replace(/: (".*?")/g,  ': <span class="json-str">$1</span>')
    .replace(/: (true|false)/g, ': <span class="json-bool">$1</span>')
    .replace(/: (\d+\.?\d*)/g,  ': <span class="json-num">$1</span>')
    .replace(/: (null)/g,   ': <span class="json-bool">$1</span>');
}
</script>
</body>
</html>
