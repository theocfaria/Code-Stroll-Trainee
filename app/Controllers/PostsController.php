<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{

    public function index()
    {

        $posts = App::get('database') -> selectAll('posts');

        return view('admin/tabela_posts', compact('posts'));
    }

    public function store()
    {
        $temporario = $_FILES['image']['tmp_name'];
        $nome_imagem = sha1(uniqid($_FILES['image']['name'], true)) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $caminho_da_imagem = "public/assets/" . $nome_imagem;
        move_uploaded_file($temporario, $caminho_da_imagem);

        $parameters = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'author' => 1,
        'created_at' => $_POST['created_at'],
        'image' => $caminho_da_imagem,
        ];

        App::get('database') -> insert('posts', $parameters);

        header('Location: /crudPosts');
    }

    public function edit()
    {
        $id = $_POST['id'];
        $post = App::get('database')->selectOne('posts', $id);
        $caminho_da_imagem = $post->image;

        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
        {
            $temporario = $_FILES['image']['tmp_name'];
            $nome_imagem = sha1(uniqid($_FILES['image']['name'], true)) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $caminho_da_imagem = "public/assets/" . $nome_imagem;
            move_uploaded_file($temporario, $caminho_da_imagem);

            if($post && !empty($post->image) && file_exists($post->image))
                {
                    unlink($post->image);
                }
        }

        $parameters = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'author' => $_POST['author'],
        'created_at' => $_POST['created_at'],
        'image' => $caminho_da_imagem,
        ];

        App::get('database') -> update('posts', $id, $parameters);
        header('Location: /crudPosts');
    }

    public function delete()
    {
        $id = $_POST['id'];
        $post = App::get('database')->selectOne('posts', $id);
        $caminho_da_imagem = $post->image;

        if(file_exists($caminho_da_imagem))
        {
            unlink($caminho_da_imagem);
        }

        App::get('database') -> delete('posts', $id);
        header('Location: /crudPosts');
    }

}

    