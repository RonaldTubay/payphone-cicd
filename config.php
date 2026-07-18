<?php

loadLocalEnv(__DIR__ . '/.env');

define('PAYPHONE_TOKEN', envValue('PAYPHONE_TOKEN', ''));
define('PAYPHONE_STORE_ID', envValue('PAYPHONE_STORE_ID', ''));
define('PAYPHONE_BASE_URL', rtrim(envValue('PAYPHONE_BASE_URL', 'http://localhost:8080'), '/'));
define('PAYPHONE_PREPARE_URL', 'https://pay.payphonetodoesposible.com/api/button/Prepare');
define('PAYPHONE_CONFIRM_URL', 'https://pay.payphonetodoesposible.com/api/button/V2/Confirm');

function envValue(string $key, string $default = ''): string
{
    $value = getenv($key);
    return $value === false ? $default : $value;
}

function loadLocalEnv(string $path): void
{
    if (!is_file($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = array_map('trim', explode('=', $line, 2));
        $value = trim($value, "\"'");

        if (getenv($key) === false) {
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
        }
    }
}

function validatePayPhoneConfig(): ?array
{
    $missing = [];

    if (PAYPHONE_TOKEN === '') {
        $missing[] = 'PAYPHONE_TOKEN';
    }

    if (PAYPHONE_STORE_ID === '') {
        $missing[] = 'PAYPHONE_STORE_ID';
    }

    if ($missing === []) {
        return null;
    }

    return [
        'error' => 'Faltan variables de entorno para PayPhone.',
        'missing' => $missing,
    ];
}
