<?php

declare(strict_types=1);

namespace App\Controllers;

class InputController
{
    public function index(array $input): array
    {
        return [
            'status'  => 200,
            'message' => 'Hello world!',
            'vars'    => [
                'vars'   => $input,
                '$_GET'  => $_GET,
                '$_POST' => $_POST,
            ],
        ];
    }

    public function store(array $input): array
    {
        return [
            'status'  => 201,
            'message' => 'Hello world!',
            'vars'    => [
                'vars'   => $input,
                '$_GET'  => $_GET,
                '$_POST' => $_POST,
            ],
        ];
    }
}
