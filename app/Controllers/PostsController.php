<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

        $isAdmin = ($_SESSION['email'] === 'admin@admin.com');
        $userId = $_SESSION['id'];

        $page = 1;
        if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
            $page = intval($_GET['pagina']);
            if ($page <= 0) $page = 1;
        }

        $itemsPagina = 6;
        $inicio = $itemsPagina * $page - $itemsPagina;

        if ($isAdmin) {
            $linhas = App::get('database')->countAll('posts');
        } else {
            $linhas = App::get('database')->countPostsByAuthor('posts', $userId);
        }

        if ($inicio > $linhas && $linhas > 0) {
            $page = 1;
            $inicio = 0;
        }

        $total = ceil($linhas / $itemsPagina);

        if ($isAdmin) {
            $posts = App::get('database')->selectPostsAutores($inicio, $itemsPagina);
        } else {
            $posts = App::get('database')->selectPostsByAuthorId($userId, $inicio, $itemsPagina);
        }

        return view('admin/tabela_posts', compact('posts', 'page', 'total'));
    }

    public function store()
    {
        session_start();

        $temporario = $_FILES['image']['tmp_name'];
        $nome_imagem = sha1(uniqid($_FILES['image']['name'], true)) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $caminho_da_imagem = "public/assets/" . $nome_imagem;
        move_uploaded_file($temporario, $caminho_da_imagem);

        $authorId = $_SESSION['id'];

        $parameters = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'author' => $authorId,
            'created_at' => $_POST['created_at'],
            'image' => $caminho_da_imagem,
        ];

        App::get('database')->insert('posts', $parameters);

        header('Location: /crudPosts');
    }

    public function delete()
    {
        session_start();
        $id = $_POST['id'];

        $post = App::get('database')->selectOne('posts', $id);

        if ($_SESSION['email'] !== 'admin@admin.com' && $post->author != $_SESSION['id']) {
            header('Location: /crudPosts');
            exit;
        }

        $caminho_da_imagem = $post->image;

        if (file_exists($caminho_da_imagem)) {
            unlink($caminho_da_imagem);
        }

        App::get('database')->delete('posts', $id);
        header('Location: /crudPosts');
    }
}
