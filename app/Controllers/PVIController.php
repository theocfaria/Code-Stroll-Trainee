<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PVIController
{
    public function index()
    {
        if (!isset($_GET['id'])) {
            return redirect('');
        }

        $id = $_GET['id'];

        $PVI = App::get('database')->FindByID('posts', $id);
        
        if(!$PVI){
            redirect('');
        }

        $AUTOR = App::get('database')->FindByID('users', $PVI[0]->author);

        $postsRecentes = App::get('database')->selectPostsRecentes(3);

        return view('site/post_individual', [
            'posts' => $PVI,
            'postID' => $AUTOR,
            'recentPosts' => $postsRecentes
        ]);
    }
}