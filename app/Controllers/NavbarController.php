<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class NavbarController
{
    public function search()
    {
        $busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

        $page = 1;

        if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
            $page = intval($_GET['pagina']);

            if ($page <= 0) {
                return redirect('/lista-de-posts'); 
            }
        }

        $itemsPagina = 5;
        $inicio = $itemsPagina * $page - $itemsPagina;

        if ($busca === '') {
            $linhas = App::get('database')->countAll('posts');
            
            if ($inicio > $linhas && $linhas > 0) {
                return redirect('/lista-de-posts');
            }
            $posts = App::get('database')->selectPostsAutores($inicio, $itemsPagina);
        } else {
            $linhas = App::get('database')->countFromSearch('posts', $busca);
            
            if ($inicio > $linhas && $linhas > 0) {
                return redirect('/lista-de-posts');
            }
            $posts = App::get('database')->searchFromDB($busca, $inicio, $itemsPagina);
        }
        
        $total = ($linhas > 0) ? ceil($linhas / $itemsPagina) : 1;

        return view('site/lista-de-posts', compact('posts', 'page', 'total', 'busca'));
    }
}