<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Controllers\UsersControler;
use App\Core\Router;

$router->get('', 'ExampleController@index');

$router->get('crudUsers', 'UsersController@index');
$router->post('crudUsers/create', 'UsersController@store');
$router->post('crudUsers/edit', 'UsersController@edit');
$router->post('crudUsers/delete', 'UsersController@delete');