<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Controller
{

    public function exibirLogin(): mixed
    {
        return view(name: 'admin/login');
    }

    public function exibirDashboard(): mixed
    {
        return view(name: 'admin/dashboard');
    }

    public function efetuarLogin(): void
    {
        $email = $_POST['email'];
        $senha = $_POST['senha']; 

        $user = App::get('database')->verificaLogin($email, $senha);
    }
}
