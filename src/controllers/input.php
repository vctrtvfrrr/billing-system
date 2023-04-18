<?php

declare(strict_types=1);

$inputController = function (array $input): array {
    return [
        'status'  => 200,
        'message' => 'Hello world!',
        'vars'    => [
            'vars'   => $input,
            '$_GET'  => $_GET,
            '$_POST' => $_POST,
        ],
    ];
};

return $inputController;
