<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsersControler{

    public function index()
    {
        $users = App::get('database')->selectAll('users');

        return view('admin/lista_usuarios', compact('users'));
    }
    public function store()
    {
        $parameters = [
        'id' => 1,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'senha' => $_POST['password'],
        ];

        App::get('database') -> insert('users', $parameters);

        header('Location: /crudUsers');
    }

    public function edit()
    {
        $id = $_POST['id'];
        $post = App::get('database')->selectOne('users', $id);
       $parameters = [
        'id' => 1,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'senha' => $_POST['password'],
        ];
        App::get('database') -> update('users', $id, $parameters);
        header('Location: /crudPosts');
    
    }

    public function delete()
    {
        $id = $_POST['id'];
        $users = App::get('database')->selectOne('users', $id);

        App::get('database') -> delete('users', $id);
        header('Location: /crudUsers');
    }
}