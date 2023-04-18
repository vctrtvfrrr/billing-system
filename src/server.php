<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use FastRoute\Dispatcher;
use Swoole\Http\Request;
use Swoole\Http\Response;

$routes = require __DIR__.'/routes.php';
$dispatcher = FastRoute\simpleDispatcher($routes);

function handleRequest(Dispatcher $dispatcher, Request $request, Response $response)
{
    [$code, $handler, $vars] = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

    switch ($code) {
        case FastRoute\Dispatcher::FOUND:
            $result = call_user_func($handler, $request, $response, $vars);

            break;

        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $handler;
            $result = [
                'status'  => 405,
                'message' => 'Method Not Allowed',
                'errors'  => [
                    sprintf('Method "%s" is not allowed', $_SERVER['REQUEST_METHOD']),
                ],
            ];

            break;

        case FastRoute\Dispatcher::NOT_FOUND:
        default:
            $result = [
                'status'  => 404,
                'message' => 'Not Found',
                'errors'  => [
                    sprintf('The URI "%s" was not found', $_SERVER['REQUEST_URI']),
                ],
            ];

            break;
    }

    return $result;
}

return function (Request $request, Response $response) use ($dispatcher): void {
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

    $response = handleRequest($dispatcher, $request, $response);

    $response->end();
};
