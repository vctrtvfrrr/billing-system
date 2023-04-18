<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Swoole\Http\Server;

$dispatcher = require __DIR__.'/server.php';

$host = getenv('HOST') ?: '0.0.0.0';
$port = (int) getenv('PORT') ?: 9501;

$server = new Server($host, $port);

$server->on('start', function (Server $server) use ($host, $port): void {
    echo sprintf('HTTP server is started at http://%s:%s'.PHP_EOL, $host, $port);
});

$server->on('request', $dispatcher);

$server->start();
