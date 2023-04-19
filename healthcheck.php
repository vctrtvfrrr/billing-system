<?php

declare(strict_types=1);

require_once './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

if ($_ENV['APP_ENV'] === 'local') {
    exit(0);
}

$url = rtrim($_ENV['APP_URL'], '/').'/ping';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$head = curl_exec($ch);

if ($head === false) {
    exit(1);
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($httpCode >= 400) {
    exit(1);
}

exit(0);
