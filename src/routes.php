<?php

declare(strict_types=1);

use App\Controllers\InputController;
use FastRoute\RouteCollector;

return function (RouteCollector $router): void {
    $router->get('/', [InputController::class, 'index']);
    $router->post('/', [InputController::class, 'store']);
};
