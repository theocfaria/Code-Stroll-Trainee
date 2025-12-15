<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Login_DashboardController
{
    public function exibirLogin()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            $this->redirecionarUsuario($_SESSION['email']);
        }
        return view('site/login');
    }

    public function exibirDashboard()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@admin.com') {
            header('Location: /crudPosts');
            exit;
        }

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
            $_SESSION['email'] = $user->email;
            $_SESSION['name'] = $user->name;

            $this->redirecionarUsuario($user->email);
            exit;
        } else {
            session_start();
            $_SESSION['mensagem-erro'] = "Usuário e/ou senha incorretos";
            header(header: 'Location: /login');
        }
    }

    private function redirecionarUsuario($email)
    {
        if ($email === 'admin@admin.com') {
            header('Location: /dashboard');
        } else {
            header('Location: /crudPosts');
        }
        exit;
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
    }
}
