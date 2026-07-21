<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#4f46e5" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#0b0b10" media="(prefers-color-scheme: dark)" />
  <title>Resultado del Pago — TechStore</title>
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E%E2%9A%A1%3C/text%3E%3C/svg%3E" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" />

  <style>
    :root {
      /* Tema Claro */
      --bg:            #f6f7fb;
      --bg-grad:       radial-gradient(1200px 600px at 80% -10%, rgba(79,70,229,.10), transparent 60%),
                       radial-gradient(900px 500px at -10% 30%, rgba(99,102,241,.06), transparent 60%),
                       #f6f7fb;
      --surface:       #ffffff;
      --surface-2:     #f1f5f9;
      --card:          #ffffff;
      --border:        #e4e6ee;
      --border-strong: #cbd0dc;
      --accent:        #4f46e5;
      --accent-2:      #6366f1;
      --accent-soft:   rgba(79, 70, 229, 0.10);
      --green:         #16a34a;
      --green-soft:    rgba(22, 163, 74, 0.12);
      --amber:         #d97706;
      --amber-soft:    rgba(217, 119, 6, 0.12);
      --red:           #dc2626;
      --red-soft:      rgba(220, 38, 38, 0.12);
      --text:          #0f172a;
      --text-2:        #1e293b;
      --muted:         #64748b;
      --muted-2:       #94a3b8;
      --json-bg:       #f8fafc;

      --radius-sm: 8px;
      --radius:    12px;
      --radius-lg: 16px;
      --radius-xl: 20px;

      --shadow-sm: 0 1px 2px rgba(15,23,42,.06);
      --shadow:    0 10px 25px -8px rgba(15,23,42,.12), 0 4px 6px -4px rgba(15,23,42,.05);
      --shadow-lg: 0 25px 50px -12px rgba(15,23,42,.20);
      --shadow-accent: 0 8px 24px rgba(79,70,229,.30);

      --ease: cubic-bezier(.4, 0, .2, 1);
      --ease-out: cubic-bezier(.16, 1, .3, 1);
    }

    body.dark-mode {
      --bg:            #0b0b10;
      --bg-grad:       radial-gradient(1200px 600px at 80% -10%, rgba(91,106,247,.20), transparent 60%),
                       radial-gradient(900px 500px at -10% 30%, rgba(124,139,255,.10), transparent 60%),
                       #0b0b10;
      --surface:       #14141c;
      --surface-2:     #191922;
      --card:          #1c1c27;
      --border:        #262636;
      --border-strong: #3a3a52;
      --accent:        #6366f1;
      --accent-2:      #818cf8;
      --accent-soft:   rgba(99,102,241,.16);
      --green:         #22c55e;
      --green-soft:    rgba(34,197,94,.18);
      --amber:         #f59e0b;
      --amber-soft:    rgba(245,158,11,.18);
      --red:           #ef4444;
      --red-soft:      rgba(239,68,68,.18);
      --text:          #eef0f7;
      --text-2:        #cbd5e1;
      --muted:         #9797b5;
      --muted-2:       #6f6f8a;
      --json-bg:       #0e0e17;

      --shadow-sm: 0 1px 2px rgba(0,0,0,.35);
      --shadow:    0 10px 25px -8px rgba(0,0,0,.45);
      --shadow-lg: 0 25px 50px -12px rgba(0,0,0,.55);
      --shadow-accent: 0 8px 24px rgba(99,102,241,.35);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    *:focus-visible { outline: 2px solid var(--accent); outline-offset: 2px; border-radius: 6px; }

    body {
      font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
      background: var(--bg-grad);
      background-attachment: fixed;
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      transition: background 0.3s var(--ease), color 0.3s var(--ease);
    }

    /* ── HEADER MINI ── */
    .brand {
      display: flex;
      align-items: center;
      gap: 0.55rem;
      margin-bottom: 1.5rem;
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: 1.15rem;
      letter-spacing: -0.5px;
      color: var(--text);
      text-decoration: none;
    }
    .brand-mark {
      width: 30px; height: 30px;
      border-radius: 8px;
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.95rem;
      color: #fff;
      box-shadow: var(--shadow-accent);
    }
    .brand span { color: var(--accent-2); }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-xl);
      padding: 2.5rem 2rem;
      width: 100%;
      max-width: 560px;
      box-shadow: var(--shadow);
      animation: fadeUp .5s var(--ease-out);
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(15px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── STATUS HERO ── */
    .status-hero {
      text-align: center;
      padding: 0.5rem 0 1.5rem;
      position: relative;
    }
    .status-icon {
      width: 84px;
      height: 84px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      margin-bottom: 1rem;
      position: relative;
    }
    .status-icon::after {
      content: '';
      position: absolute;
      inset: -6px;
      border-radius: 50%;
      border: 2px solid transparent;
      animation: pulse 2s var(--ease-out) infinite;
    }
    .status-icon.success       { background: var(--green-soft); color: var(--green); }
    .status-icon.success::after { border-color: var(--green); }
    .status-icon.error         { background: var(--red-soft); color: var(--red); }
    .status-icon.error::after   { border-color: var(--red); }
    .status-icon.pending       { background: var(--amber-soft); color: var(--amber); }
    .status-icon.pending::after { border-color: var(--amber); }

    @keyframes pulse {
      0%   { transform: scale(1);   opacity: 1; }
      100% { transform: scale(1.4); opacity: 0; }
    }

    .status-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.65rem;
      font-weight: 700;
      letter-spacing: -0.5px;
      margin-bottom: 0.4rem;
      color: var(--text);
    }
    .status-subtitle {
      color: var(--muted);
      font-size: 0.95rem;
      line-height: 1.5;
      max-width: 400px;
      margin: 0 auto;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      font-size: 0.72rem;
      font-weight: 700;
      padding: 5px 12px;
      border-radius: 999px;
      margin-top: 1rem;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .badge-approved { background: var(--green-soft); color: var(--green); }
    .badge-canceled { background: var(--red-soft);   color: var(--red); }
    .badge-pending  { background: var(--amber-soft); color: var(--amber); }

    /* ── AMOUNT DISPLAY ── */
    .amount-display {
      text-align: center;
      padding: 1.25rem;
      background: var(--surface-2);
      border-radius: var(--radius);
      margin: 1.5rem 0;
    }
    .amount-label {
      font-size: 0.75rem;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.35rem;
      font-weight: 600;
    }
    .amount-value {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 2rem;
      font-weight: 700;
      color: var(--accent);
      letter-spacing: -0.75px;
    }
    .amount-currency {
      font-size: 0.9rem;
      color: var(--muted);
      margin-left: 0.35rem;
      font-weight: 500;
    }

    /* ── INFO BOX ── */
    .info-box {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.1rem 1.2rem;
      margin-bottom: 1rem;
    }
    .info-box-title {
      font-size: 0.72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--muted);
      margin-bottom: 0.85rem;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 0.5rem 0;
      border-bottom: 1px solid var(--border);
      font-size: 0.87rem;
      gap: 1rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-key { color: var(--muted); flex-shrink: 0; font-weight: 500; }
    .info-val {
      font-weight: 600;
      text-align: right;
      word-break: break-all;
      color: var(--text);
      font-family: 'Space Grotesk', sans-serif;
      letter-spacing: -0.2px;
    }
    .info-val.green  { color: var(--green); }
    .info-val.red    { color: var(--red); }
    .info-val.amber  { color: var(--amber); }
    .info-val.blue   { color: var(--accent); }
    .info-val.mono   { font-family: 'Courier New', monospace; font-size: 0.82rem; }

    /* ── JSON BLOCK ── */
    details.json-details {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      margin-bottom: 1.2rem;
      overflow: hidden;
    }
    details.json-details summary {
      padding: 0.9rem 1.2rem;
      cursor: pointer;
      font-size: 0.78rem;
      font-weight: 700;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      user-select: none;
      list-style: none;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background .2s var(--ease);
    }
    details.json-details summary:hover { background: var(--surface-2); color: var(--text); }
    details.json-details summary::-webkit-details-marker { display: none; }
    details.json-details summary::after {
      content: '›';
      font-size: 1.4rem;
      transition: transform .2s var(--ease);
    }
    details.json-details[open] summary::after { transform: rotate(90deg); }

    .json-block {
      background: var(--json-bg);
      padding: 1rem 1.2rem;
      font-family: 'Courier New', monospace;
      font-size: 0.78rem;
      line-height: 1.7;
      overflow-x: auto;
      white-space: pre;
      color: var(--text-2);
      border-top: 1px solid var(--border);
    }
    .json-key  { color: var(--accent); }
    .json-str  { color: var(--green); }
    .json-num  { color: var(--amber); }
    .json-bool { color: var(--red); }

    /* ── BUTTONS ── */
    .actions {
      display: flex;
      gap: 0.6rem;
      margin-top: 0.5rem;
    }
    .btn {
      flex: 1;
      text-align: center;
      padding: 0.9rem 1rem;
      border-radius: var(--radius);
      font-family: inherit;
      font-size: 0.92rem;
      font-weight: 700;
      cursor: pointer;
      border: none;
      text-decoration: none;
      transition: transform .12s var(--ease), box-shadow .2s var(--ease), background .2s var(--ease);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.4rem;
    }
    .btn:active { transform: scale(.98); }
    .btn-primary {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
      color: #fff;
      box-shadow: var(--shadow-accent);
    }
    .btn-primary:hover { filter: brightness(1.08); }
    .btn-ghost {
      background: var(--card);
      color: var(--text);
      border: 1px solid var(--border);
    }
    .btn-ghost:hover { background: var(--surface-2); border-color: var(--border-strong); }

    /* ── LOADING ── */
    #loading-section { text-align: center; padding: 2rem 1rem; }
    .spinner {
      width: 56px; height: 56px;
      border: 4px solid var(--border);
      border-top-color: var(--accent);
      border-radius: 50%;
      animation: spin .8s linear infinite;
      margin: 0 auto 1.5rem;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .loading-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--text);
    }
    .loading-detail {
      color: var(--muted);
      font-size: 0.82rem;
      font-family: 'Courier New', monospace;
    }

    #result-section { display: none; }

    /* ── FOOTER ── */
    .card-footer {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 0.78rem;
      color: var(--muted-2);
    }
    .card-footer .secure {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
    }

    @media (max-width: 480px) {
      .card { padding: 2rem 1.35rem; }
      .status-title { font-size: 1.4rem; }
      .amount-value { font-size: 1.65rem; }
      .actions { flex-direction: column; }
    }
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: .01ms !important;
        transition-duration: .01ms !important;
      }
    }
  </style>
</head>
<body>

<a class="brand" href="index.html" aria-label="Volver a TechStore">
  <span class="brand-mark" aria-hidden="true">⚡</span>
  Tech<span>Store</span>
</a>

<div class="card">

  <!-- ── CARGANDO ── -->
  <div id="loading-section">
    <div class="spinner" aria-hidden="true"></div>
    <p class="loading-title">Confirmando tu pago…</p>
    <p class="loading-detail" id="loading-detail">Contactando con PayPhone</p>
  </div>

  <!-- ── RESULTADO ── -->
  <div id="result-section">
    <div class="status-hero">
      <div class="status-icon" id="res-icon" aria-hidden="true"></div>
      <h1 class="status-title" id="res-title"></h1>
      <p class="status-subtitle" id="res-subtitle"></p>
      <span class="badge" id="res-badge"></span>
    </div>

    <div class="amount-display" id="amount-display" hidden>
      <div class="amount-label">Monto pagado</div>
      <div>
        <span class="amount-value" id="amount-value">$0.00</span>
        <span class="amount-currency" id="amount-currency">USD</span>
      </div>
    </div>

    <div class="info-box">
      <div class="info-box-title"><span aria-hidden="true">📋</span> Detalle de la transacción</div>
      <div id="confirm-rows"></div>
    </div>

    <details class="json-details">
      <summary><span>🔍 Ver respuesta completa (JSON)</span></summary>
      <pre class="json-block" id="json-block"></pre>
    </details>

    <div class="actions">
      <a class="btn btn-ghost" href="index.html">← Seguir comprando</a>
      <button type="button" class="btn btn-primary" onclick="window.print()">🖨️ Imprimir</button>
    </div>
  </div>

  <div class="card-footer">
    <span class="secure"><span aria-hidden="true">🔒</span> Procesado de forma segura por PayPhone</span>
  </div>

</div>

<?php

require_once __DIR__ . '/config.php';

$ppId       = intval($_GET['id'] ?? 0);
$clientTxId = trim($_GET['clientTransactionId'] ?? '');

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

$jsData = json_encode([
    'ppId'          => $ppId,
    'clientTxId'    => $clientTxId,
    'confirmResult' => $confirmResult,
    'confirmError'  => $confirmError,
    'httpStatus'    => $httpStatus,
]);
?>

<script>
const SERVER_DATA = <?= $jsData ?>;

// ── Aplicar tema guardado (respeta la elección del index) ────────────────
(function initTheme() {
  const saved = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  if (saved === 'dark' || (!saved && prefersDark)) {
    document.body.classList.add('dark-mode');
  }
})();

// ── Renderizar resultado ─────────────────────────────────────────────────
(function() {
  const { ppId, clientTxId, confirmResult, confirmError, httpStatus } = SERVER_DATA;

  document.getElementById('loading-section').style.display = 'none';
  document.getElementById('result-section').style.display  = 'block';

  const iconEl     = document.getElementById('res-icon');
  const titleEl    = document.getElementById('res-title');
  const subtitleEl = document.getElementById('res-subtitle');
  const badgeEl    = document.getElementById('res-badge');
  const rowsEl     = document.getElementById('confirm-rows');
  const jsonEl     = document.getElementById('json-block');
  const amountBox  = document.getElementById('amount-display');
  const amountVal  = document.getElementById('amount-value');
  const amountCur  = document.getElementById('amount-currency');

  if (confirmError) {
    iconEl.textContent    = '⚠';
    iconEl.className      = 'status-icon error';
    titleEl.textContent   = 'Error al confirmar';
    subtitleEl.textContent = confirmError;
    badgeEl.textContent   = 'Error';
    badgeEl.className     = 'badge badge-canceled';
    rowsEl.innerHTML =
      `<div class="info-row"><span class="info-key">Detalle</span><span class="info-val red">${confirmError}</span></div>`;
    jsonEl.textContent = JSON.stringify({ error: confirmError }, null, 2);
    return;
  }

  const r        = confirmResult || {};
  const sc       = r.statusCode ?? r.StatusCode;
  const approved = sc === 3 || r.transactionStatus === 'Approved';
  const canceled = sc === 2 || r.transactionStatus === 'Canceled';

  if (approved) {
    iconEl.textContent    = '✓';
    iconEl.className      = 'status-icon success';
    titleEl.textContent   = '¡Pago aprobado!';
    subtitleEl.textContent = 'Tu transacción fue procesada exitosamente. Recibirás la confirmación en tu correo.';
    badgeEl.textContent   = 'Aprobado';
    badgeEl.className     = 'badge badge-approved';
  } else if (canceled) {
    iconEl.textContent    = '✕';
    iconEl.className      = 'status-icon error';
    titleEl.textContent   = 'Pago cancelado';
    subtitleEl.textContent = 'La transacción fue cancelada o rechazada. No se realizó ningún cargo.';
    badgeEl.textContent   = 'Cancelado';
    badgeEl.className     = 'badge badge-canceled';
  } else {
    iconEl.textContent    = '⏱';
    iconEl.className      = 'status-icon pending';
    titleEl.textContent   = 'Estado pendiente';
    subtitleEl.textContent = r.message || 'No se pudo determinar el estado del pago.';
    badgeEl.textContent   = 'Pendiente';
    badgeEl.className     = 'badge badge-pending';
  }

  // Monto destacado
  if (r.amount) {
    amountBox.hidden = false;
    amountVal.textContent = '$' + (r.amount / 100).toFixed(2);
    amountCur.textContent = r.currency || 'USD';
  }

  // Filas de detalle (solo las relevantes)
  const rows = [
    { k: 'ID Transacción PayPhone', v: r.transactionId ?? ppId ?? 'N/A', cls: 'mono blue' },
    { k: 'ID Cliente',              v: r.clientTransactionId ?? clientTxId, cls: 'mono' },
    { k: 'Estado',                  v: r.transactionStatus ?? '—', cls: approved ? 'green' : (canceled ? 'red' : 'amber') },
    { k: 'Código autorización',     v: r.authorizationCode ?? 'N/A', cls: 'mono blue' },
    { k: 'Tarjeta',                 v: r.cardBrand ? `${r.cardBrand} •••• ${r.lastDigits ?? '—'}` : '—' },
    { k: 'Correo',                  v: r.email ?? '—' },
    { k: 'Mensaje',                 v: r.message ?? '—' },
    { k: 'HTTP Status',             v: httpStatus ?? '—', cls: 'mono' },
  ];

  rowsEl.innerHTML = rows.map(row =>
    `<div class="info-row">
       <span class="info-key">${row.k}</span>
       <span class="info-val ${row.cls || ''}">${escapeHTML(String(row.v))}</span>
     </div>`
  ).join('');

  jsonEl.innerHTML = syntaxHighlight(JSON.stringify(confirmResult, null, 2));
})();

function escapeHTML(str) {
  return String(str).replace(/[&<>"']/g, (c) => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
  }[c]));
}

function syntaxHighlight(json) {
  if (!json) return '{}';
  return escapeHTML(json)
    .replace(/(&quot;.*?&quot;):/g,      '<span class="json-key">$1</span>:')
    .replace(/: (&quot;.*?&quot;)/g,     ': <span class="json-str">$1</span>')
    .replace(/: (true|false)/g,          ': <span class="json-bool">$1</span>')
    .replace(/: (\d+\.?\d*)/g,           ': <span class="json-num">$1</span>')
    .replace(/: (null)/g,                ': <span class="json-bool">$1</span>');
}
</script>
</body>
</html>
