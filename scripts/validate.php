<?php

$root = dirname(__DIR__);
$requiredFiles = [
    'index.html',
    'payphone-proxy.php',
    'response.php',
    'config.php',
    '.env.example',
];

foreach ($requiredFiles as $file) {
    $path = $root . DIRECTORY_SEPARATOR . $file;
    if (!is_file($path)) {
        fwrite(STDERR, "Falta archivo requerido: {$file}" . PHP_EOL);
        exit(1);
    }
}

$index = file_get_contents($root . DIRECTORY_SEPARATOR . 'index.html');
$proxy = file_get_contents($root . DIRECTORY_SEPARATOR . 'payphone-proxy.php');

if (!str_contains($index, 'payphone-proxy.php?action=prepare')) {
    fwrite(STDERR, "El boton de pago no apunta al proxy de PayPhone." . PHP_EOL);
    exit(1);
}

if (!str_contains($proxy, 'PAYPHONE_PREPARE_URL')) {
    fwrite(STDERR, "El proxy no usa la configuracion central de PayPhone." . PHP_EOL);
    exit(1);
}

echo "Validacion funcional completada correctamente." . PHP_EOL;
