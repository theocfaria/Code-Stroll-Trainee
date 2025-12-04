<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Login_DashboardController
{
    public function redirecionaTabela()
    {
        return view('admin/tabela_posts', compact('posts'));
    }

    public function exibirLogin()
    {
        session_start();

        if (isset($_SESSION['id'])) {
            header('Location: /dashboard');
        }

        return view('site/login');
    }

    public function exibirDashboard()
    {

        return view('admin/dashboard');
    }

    public function efetuarLogin(): void
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $user = App::get('database')->verificaLogin($email, $senha);

        if ($user != false) {
            session_start();
            $_SESSION['id'] = $user->id;
            header(header: 'Location: /dashboard');
            exit;
        } else {
            session_start();
            $_SESSION['mensagem-erro'] = "Usuário e/ou senha incorretos";
            header(header: 'Location: /login');
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