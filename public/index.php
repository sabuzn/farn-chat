<?php

declare(strict_types=1);

// 1. Carrega as dependências externas do vendor (se houver)
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once dirname(__DIR__) . '/vendor/autoload.php';
}

// 2. Carrega o bootstrap e o Router (com namespace App)
require_once dirname(__DIR__) . '/app/bootstrap.php';
require_once dirname(__DIR__) . '/app/Router.php';

use App\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\ChatController;

$router = new Router();

# =+=+=+==+=+=+= Páginas Públicas =+=+=+==+=+=+=

# Agora a raiz '/' é a página de marketing (com descrição e botão de login)
$router->get('/', [HomeController::class, 'index']);

# ————————————————————————————————————————

# =+=+=+==+=+=+= Área Autenticada (Dashboard) =+=+=+==+=+=+=

# Esta é a rota que vai carregar o layout de 3 colunas que criamos em homepage.php
$router->get('/dashboard', [ChatController::class, 'index']);

# API que alimenta o chat via Ajax/Fetch
$router->get('/api/channels/{channelId}/messages', [ChatController::class, 'getHistory']);

# ————————————————————————————————————————

# =+=+=+==+=+=+= Signup =+=+=+==+=+=+=
# -------------- View --------------
$router->get('/signup', [UserController::class, 'renderSignup']);

# -------------- Controller --------------
$router->post('/signup', [UserController::class, 'signup']);

# ————————————————————————————————————————

# =+=+=+==+=+=+= Signin =+=+=+==+=+=+=
# -------------- View --------------
$router->get('/signin', [UserController::class, 'renderSignin']);

# -------------- Controller --------------
$router->post('/signin', [UserController::class, 'signin']);

# ————————————————————————————————————————

# =+=+=+==+=+=+= Forgot Password =+=+=+==+=+=+=
# -------------- View --------------
$router->get('/forgot-password', [UserController::class, 'renderForgotPassword']);

# -------------- Controller --------------
$router->post('/forgot-password', [UserController::class, 'forgotPassword']);

# ————————————————————————————————————————

// Captura o método HTTP da requisição atual
$method = $_SERVER['REQUEST_METHOD'];

// Captura a URI limpa (o Router já trata o parse_url internamente se necessário, 
// mas passando a string bruta funciona perfeitamente)
$uri = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $uri);
