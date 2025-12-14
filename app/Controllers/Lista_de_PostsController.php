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
    $busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

    $page = 1;

    if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
        $page = intval($_GET['pagina']);
        if ($page <= 0) {
            $page = 1;
        }
    }

    $itemsPagina = 5;
    $inicio = $itemsPagina * $page - $itemsPagina;

    if ($busca === '') {
        $linhas = App::get('database')->countAll('posts');
        
        if ($inicio > $linhas && $linhas > 0) {
            $page = 1;
            $inicio = 0; 
        }
        
        $posts = App::get('database')->selectPostsAutores($inicio, $itemsPagina);
    } else {
        $linhas = App::get('database')->countFromSearch('posts', $busca);
        
        if ($inicio > $linhas && $linhas > 0) {
            $page = 1;
            $inicio = 0;
        }
        
        $posts = App::get('database')->searchFromDB($busca, $inicio, $itemsPagina);
    }

    $total = ($linhas > 0) ? ceil($linhas / $itemsPagina) : 1;

    return view('site/lista_de_posts', compact('posts', 'page', 'total', 'busca'));

}
}
