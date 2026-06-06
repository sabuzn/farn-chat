<?php

declare(strict_types=1);

// 1. Carrega as dependências externas do vendor (se houver)
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once dirname(__DIR__) . '/vendor/autoload.php';
}

// 2. Carrega o nosso bootstrap (que agora tem o autoloader da pasta app/)
require_once dirname(__DIR__) . '/app/bootstrap.php';
require_once dirname(__DIR__) . '/app/Router.php';

$router = new Router();

# =+=+=+==+=+=+= Home =+=+=+==+=+=+=
$router->get('/', [
    'app\Controllers\HomeController',
    'index'
]);

# ————————————————————————————————————————

# =+=+=+==+=+=+= Signup =+=+=+==+=+=+=
# -------------- View --------------
$router->get('/signup', [
    'app\Controllers\UserController',
    'renderSignup'
]);

# -------------- Controller --------------
$router->post('/signup', [
    'app\Controllers\UserController',
    'signup'
]);

# ————————————————————————————————————————

# =+=+=+==+=+=+= Signin =+=+=+==+=+=+=
# -------------- View --------------
$router->get('/signin', [
    'app\Controllers\UserController',
    'renderSignin'
]);

# -------------- Controller --------------
$router->post('/signin', [
    'app\Controllers\UserController',
    'signin'
]);

# ————————————————————————————————————————

# =+=+=+==+=+=+= Forgot Password =+=+=+==+=+=+=
# -------------- View --------------
$router->get('/forgot-password', [
    'app\Controllers\UserController',
    'renderForgotPassword'
]);

# -------------- Controller --------------
$router->post('/forgot-password', [
    'app\Controllers\UserController',
    'forgotPassword'
]);

# ————————————————————————————————————————

$method = $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
