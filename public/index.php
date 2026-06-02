<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/Router.php';
require_once dirname(__DIR__) . '/app/bootstrap.php';

$router = new Router();

$router->get('/', [app\Controllers\HomeController::class, 'index']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
