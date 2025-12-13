<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PVIController
{
    public function index()
    {
        $id = $_GET['id'];
        //var_dump($id);
        //exit();

        if(!$id){
            redirect('');
        }

        $PVI = App::get('database')->FindByID('posts', $id);
        

        if(!$PVI){
            redirect('');
        }

        $AUTOR = App::get('database')->FindByID('users', $PVI[0]->author);

        return view('site/post_individual', [
            'posts' => $PVI,
            'postID' => $AUTOR

        ]);
    }

}

    