<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');

$router->get('crudPosts', 'PostsController@index');
$router->post('crudPosts/create', 'PostsController@store');
$router->post('crudPosts/edit', 'PostsController@edit');
$router->post('crudPosts/delete', 'PostsController@delete');