<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('login', 'Login_DashboardController@exibirLogin');
$router->get('dashboard', 'Login_DashboardController@exibirDashboard');
$router->post('login', 'Login_DashboardController@efetuarLogin');
$router->post('logout', 'Login_DashboardController@logout');
$router->get('crudUsers', 'Login_DashboardController@redirecionaTabela'); 
$router->get('crudPosts', 'Login_DashboardController@redirecionaTabela'); 
$router->get('cadastro', 'CadastroController@index'); 

$router->get('crudPosts', 'PostsController@index');
$router->post('crudPosts/create', 'PostsController@store');
$router->post('crudPosts/edit', 'PostsController@edit');
$router->post('crudPosts/delete', 'PostsController@delete');
$router->get('posts/search', 'PostsController@search');
  
$router->get('crudUsers', 'UsersController@index');
$router->post('crudUsers/create', 'UsersController@store');
$router->post('crudUsers/edit', 'UsersController@edit');
$router->post('crudUsers/delete', 'UsersController@delete');
$router->get('crudUsers/search', 'UsersController@search');