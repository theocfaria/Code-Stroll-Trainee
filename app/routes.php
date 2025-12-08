<?php

//namespace App\Controllers;
//use App\Controllers\ExampleController;
use App\Core\Router;

//tabela posts
$router->get('crudPosts', 'PostsController@index');
$router->post('crudPosts/create', 'PostsController@store');
$router->post('crudPosts/edit', 'PostsController@edit');
$router->post('crudPosts/delete', 'PostsController@delete');
$router->get('crudPosts/search', 'PostsController@search');

//login
$router->get('login', 'Login_DashboardController@exibirLogin');
$router->get('dashboard', 'Login_DashboardController@exibirDashboard');
$router->get('sidebar', 'SidebarController@exibirSidebar');  //Ãºltima que criei
$router->post('login', 'Login_DashboardController@efetuarLogin');
$router->post('logout', 'Login_DashboardController@logout');

//tabela usuarios
$router->get('crudUsers', 'UsersController@index');
$router->post('crudUsers/create', 'UsersController@store');
$router->post('crudUsers/edit', 'UsersController@edit');
$router->post('crudUsers/delete', 'UsersController@delete');
$router->get('crudUsers/search', 'UsersController@search');

//landing page
$router->get('', 'LandingPageController@index');

//sobre nos
$router->get('sobre-nos', 'SobreNosController@index');

//lista de posts
$router->get('lista-de-posts', 'Lista_de_PostsController@index');

//cadastro
$router->get('cadastro', 'CadastroController@index');