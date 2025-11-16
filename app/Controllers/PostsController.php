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
        $parameters = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'author' => $_POST['author'],
        'created_at' => $_POST['created_at'],
        'image' => $_POST['image'],
        ];

        App::get('database') -> insert('posts', $parameters);

        header('Location: /crudPosts');
    }
}

    