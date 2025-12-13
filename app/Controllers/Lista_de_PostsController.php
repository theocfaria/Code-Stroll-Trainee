<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Lista_de_PostsController
{
    /*public function index()
    {
        return view('site/lista_de_posts');
    }*/
public function index()
{
    // $page = 1;

    // if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
    //     $page = intval($_GET['pagina']);

    //     if ($page <= 0) {
    //         $page = 1;
    //     }
    // }

    // $itemsPagina = 5;
    // $inicio = $itemsPagina * $page - $itemsPagina;

    // $linhas = App::get('database')->countAll('posts');

    // if ($inicio > $linhas) {
    //     $page = 1;
    // }

    // $total = ceil($linhas / $itemsPagina);

    // $posts = App::get('database')->selectPostsAutores('posts', $inicio, $itemsPagina);

    $page = 1;

        if(isset($_GET['pagina']) && !empty($_GET['pagina']))
        {
            $page = intval($_GET['pagina']);

            if($page <=0)
            {
                $page = 1;
            }
        }

        $itemsPagina = 5;

        $inicio = $itemsPagina * $page - $itemsPagina;

        $linhas = App::get('database')->countAll('posts');

        if($inicio > $linhas)
        {
            $page = 1;
        }

        $total = ceil($linhas/$itemsPagina);

        $posts = App::get('database')->selectPostsAutores($inicio, $itemsPagina);

    // Retorne a view correta
    return view('site/lista_de_posts', compact('posts', 'page', 'total'));
}
}
