<?php

declare(strict_types=1);

use FastRoute\RouteCollector;

function loadController(string $controllerName): Closure
{
    $controllerFilePath = __DIR__."/controllers/{$controllerName}.php";

    if (! file_exists($controllerFilePath)) {
        throw new Exception('Controller inexistente');
    }

    return require __DIR__."/controllers/{$controllerName}.php";
}

return function (RouteCollector $router): void {
    $router->get('/', loadController('input'));
    $router->post('/', loadController('output'));
};
