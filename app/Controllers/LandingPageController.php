<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LandingPageController
{
    public function index(){
        return view('site/landingPage');
    }
    
}
