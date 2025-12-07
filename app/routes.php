<?php

//namespace App\Controllers;
//use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('crudPosts', 'PostsController@index');
$router->post('crudPosts/create', 'PostsController@store');
$router->post('crudPosts/edit', 'PostsController@edit');
$router->post('crudPosts/delete', 'PostsController@delete');

$router->get('posts/search', 'PostsController@search');
$router->get('login', 'Controller@exibirLogin');
$router->get('dashboard', 'Controller@exibirDashboard');
$router->post('login', 'Controller@efetuarLogin');
$router->post('logout', 'Controller@logout');
$router->get('lista_usuarios', 'lista@');  //PENDENTE

$router->get('crudUsers', 'UsersController@index');
$router->post('crudUsers/create', 'UsersController@store');
$router->post('crudUsers/edit', 'UsersController@edit');
$router->post('crudUsers/delete', 'UsersController@delete');
$router->get('crudUsers/search', 'UsersController@search');

$router->get('', 'LandingPageController@index');
