<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class CadastroController
{
    public function index()
    {
        return view('site/Cadastro');
    }

    public function store()
    {
        if ($_POST['password'] !== $_POST['confirm-password']) {
            header('Location: /cadastro'); 
            exit;
        }

        $parameters = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'], 
        ];

        try {
            App::get('database')->insert('users', $parameters);
            header('Location: /login');

        } catch (Exception $e) {
            header('Location: /cadastro');
        }
    }
}