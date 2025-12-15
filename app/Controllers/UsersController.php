<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsersController
{

    public function index()
    {
        //App::get('database')->populaBancoUser('users',50);
        $users = App::get('database')->selectAll('users');

        $page = 1;

        if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
            $page = intval($_GET['pagina']);

            if ($page <= 0) {
                $page = 1;
            }
        }

        $itemsPagina = 6;

        $inicio = $itemsPagina * $page - $itemsPagina;

        $linhas = App::get('database')->countAll('users');

        if ($inicio > $linhas) {
            $page = 1;
        }

        $total = ceil($linhas / $itemsPagina);

        $users = App::get('database')->selectAll('users', $inicio, $itemsPagina);

        return view('admin/lista_usuarios', compact('users', 'page', 'total')); // pode dar merda aqui na passagem de mais variaveis
    }
    public function store()
    {
        $parameters = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ];

        App::get('database')->insert('users', $parameters);

        header('Location: /crudUsers');
    }

    public function edit()
    {
        $id = $_POST['id'];
        $parameters = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ];
        App::get('database')->update('users', $id, $parameters);
        header('Location: /crudUsers');
    }

    public function delete()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@admin.com') {
            header('Location: /login');
            exit;
        }

        $idUsuarioParaDeletar = $_POST['id'];

        $postsDoUsuario = App::get('database')->getAllPostsByAuthor($idUsuarioParaDeletar);

        foreach ($postsDoUsuario as $post) {
            if (!empty($post->image) && file_exists($post->image)) {
                unlink($post->image);
            }
        }

        App::get('database')->deleteWhere('posts', 'author', $idUsuarioParaDeletar);

        App::get('database')->delete('users', $idUsuarioParaDeletar);

        header('Location: /crudUsers');
    }

    public function search()
    {
        $busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

        $page = 1;

        if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
            $page = intval($_GET['pagina']);

            if ($page <= 0) {
                return redirect('site/crudUsers');
            }
        }

        $itemsPagina = 6;

        $inicio = $itemsPagina * ($page - 1);

        if ($busca === '') {
            $linhas = App::get('database')->countAll('users');
            if ($inicio > $linhas) {
                return redirect('site/crudUsers');
            }
            $users = App::get('database')->selectAll('users', $inicio, $itemsPagina);
        } else {
            $linhas = App::get('database')->countFromSearchUsers('users', $busca);
            if ($inicio > $linhas) {
                return redirect('site/crudUsers');
            }
            $users = App::get('database')->searchFromDBUsers($busca, $inicio, $itemsPagina);
        }
        $total = ceil($linhas / $itemsPagina);

        return view('admin/lista_usuarios', compact('users', 'page', 'total', 'busca'));
    }
}
