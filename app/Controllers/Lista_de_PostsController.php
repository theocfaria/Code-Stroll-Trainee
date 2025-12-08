<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Lista_de_PostsController
{
    public function index()
    {
        return view('site/lista_de_posts');
    }
}
