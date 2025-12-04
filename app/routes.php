<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('login', 'Controller@exibirLogin');
$router->get('dashboard', 'Controller@exibirDashboard');
$router->post('login', 'Controller@efetuarLogin');
$router->post('logout', 'Controller@logout');
$router->get('lista_usuarios', 'lista@');  //PENDENTE
