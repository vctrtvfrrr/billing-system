<?php

declare(strict_types=1);

use Swoole\Http\Request;
use Swoole\Http\Response;

$outputController = function (Request $request, Response $response, array $input): Response {
    $response->write(json_encode([
        'status'  => 200,
        'message' => 'Hello world!',
        'vars'    => [
            'vars'    => $input,
            '$_GET'   => $_GET,
            '$_POST'  => $_POST,
            '$_FILES' => $_FILES,
        ],
    ]));

    $response->status(201);

    return $response;
};

return $outputController;
