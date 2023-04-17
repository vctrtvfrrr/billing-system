<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

$routes = require __DIR__.'/routes.php';
$dispatcher = FastRoute\simpleDispatcher($routes);

function handleRequest($dispatcher, string $requestMethod, string $requestUri)
{
    [$code, $handler, $vars] = $dispatcher->dispatch($requestMethod, $requestUri);

    switch ($code) {
        case FastRoute\Dispatcher::FOUND:
            $class = new $handler[0]();
            $result = $class->{$handler[1]}($vars);

            break;

        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $handler;
            $result = [
                'status'  => 405,
                'message' => 'Method Not Allowed',
                'errors'  => [
                    sprintf('Method "%s" is not allowed', $requestMethod),
                ],
            ];

            break;

        case FastRoute\Dispatcher::NOT_FOUND:
        default:
            $result = [
                'status'  => 404,
                'message' => 'Not Found',
                'errors'  => [
                    sprintf('The URI "%s" was not found', $requestUri),
                ],
            ];

            break;
    }

    return $result;
}

$host = getenv('HOST') ?: '0.0.0.0';
$port = (int) getenv('PORT') ?: 9501;

$server = new Server($host, $port);

$server->on('start', function (Server $server) use ($host, $port): void {
    echo sprintf('HTTP server is started at http://%s:%s'.PHP_EOL, $host, $port);
});

$server->on('request', function (Request $request, Response $response) use ($dispatcher): void {
    $requestMethod = $request->server['request_method'];
    $requestUri = $request->server['request_uri'];
    $requestAddr = $request->server['remote_addr'];

    $_SERVER['REQUEST_URI'] = $requestUri;
    $_SERVER['REQUEST_METHOD'] = $requestMethod;
    $_SERVER['REMOTE_ADDR'] = $requestAddr;

    $_GET = $request->get ?? [];
    $_FILES = $request->files ?? [];

    if ($requestMethod === 'POST' && $request->header['content-type'] === 'application/json') {
        $body = $request->rawContent();
        $_POST = empty($body) ? [] : json_decode($body);
    } else {
        $_POST = $request->post ?? [];
    }

    $response->header('Content-Type', 'application/json');

    $result = handleRequest($dispatcher, $requestMethod, $requestUri);

    $response->end(json_encode($result));
});

$server->start();
