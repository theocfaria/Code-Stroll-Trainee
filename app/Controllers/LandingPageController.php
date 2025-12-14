<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LandingPageController
{
    public function index(){
        $posts = App::get('database')->selectPostsRecentes(8);

        return view('site/landingPage', compact('posts'));
    }
    
}
