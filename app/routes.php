<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('login', 'Controller@exibirLogin');
$router->get('dashboard', 'Controller@exibirDashboard');
$router->get('login', 'Controller@efetuaLogin');