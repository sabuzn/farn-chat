<?php
namespace app\Controllers;

use app\Repositories\UserRepository;

class UserController
{
    public function renderSignup() :void
    {      
        $pageTitle = "Criar Conta - Farn-Chat";
        $viewPath = __DIR__ . '/../app/Views/signup.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            http_response_code(500);
            echo "Janela não encontrada.";
        }
    }

    public function signup() :void
    {
        $userRepository = new UserRepository();
        $userRepository->createUser($_POST['username'], $_POST['password']);

        header('Location: /');
        exit();
}   
