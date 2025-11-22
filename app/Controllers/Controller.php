<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Controller
{
    public function exibirLogin()
    {
        session_start();

        if(isset($_SESSION['id'])){
            header('Location: /dashboard');
        }

        return view('site/login');
    }

    public function efetuarLogin(): void
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $user = App::get('database')->verificaLogin($email, $senha);

        if ($user != false) {
            session_start();
            $_SESSION['id'] = $user->id;
            header('Location: /dashboard');
        } else {
            session_start();
            $_SESSION['mensagem-erro'] = "Usuário e/ou senha incorretos";
            header('Location: /login');
        }
    }

    public function logout(): void
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: /login');
}
}
