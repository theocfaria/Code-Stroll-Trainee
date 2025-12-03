<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{
    public function index()
    {

        //App::get('database')->populaBanco('posts', 100);

        $page = 1;

        if(isset($_GET['pagina']) && !empty($_GET['pagina']))
        {
            $page = intval($_GET['pagina']);

            if($page <=0)
            {
                $page = 1;
            }
        }

        $itemsPagina = 8;

        $inicio = $itemsPagina * $page - $itemsPagina;

        $linhas = App::get('database')->countAll('posts');

        if($inicio > $linhas)
        {
            $page = 1;
        }

        $total = ceil($linhas/$itemsPagina);

        $posts = App::get('database') -> selectAll('posts', $inicio, $itemsPagina);

        return view('admin/tabela_posts', compact('posts', 'page', 'total')); // pode dar merda aqui na passagem de mais variaveis
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
        'author' => 1, // arrumar
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

    public function search()
    {
        $busca = isset($_GET['busca']) ? trim($_GET['busca']): '';

        $page = 1;

        if(isset($_GET['pagina']) && !empty($_GET['pagina']))
        {
            $page = intval($_GET['pagina']);

            if($page <=0)
            {
                return redirect('site/crudPosts');
            }
        }

        $itemsPagina = 8;

        $inicio = $itemsPagina * $page - $itemsPagina;

        if($busca === '')
        {
            $linhas = App::get('database')->countAll('posts');
            if($inicio > $linhas)
            {
                return redirect('site/crudPosts');
            }
            $posts = App::get('database')->selectAll('posts', $inicio, $itemsPagina);
        }
        else
        {
            $linhas = App::get('database')->countFromSearch('posts', $busca);
            if($inicio > $linhas)
            {
                return redirect('site/crudPosts');
            }
            $posts = App::get('database')->searchFromDB($busca,$inicio,$itemsPagina);
        }
        $total = ceil($linhas/$itemsPagina);


        return view('admin/tabela_posts', compact('posts', 'page', 'total', 'busca'));
    }

}

    