<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class NavbarController
{
    public function redireciona_listaposts()
    {
        return view('site/lista_de_posts');
    }

    public function redireciona_sobrenos()
    {
        return view('site/sobre_nos');
    }

    public function redireciona_login()
    {
        return view('site/login');
    }

    public function redireciona_lp()
    {
        return view('site/landingPage');
    }
}
