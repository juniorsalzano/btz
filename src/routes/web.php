<?php

$router->get('/', 'HomeController@index', false);
$router->get('/home', 'HomeController@index', false);

$router->get('/login', 'AuthController@login', false);
$router->post('/login', 'AuthController@login', false);

$router->get('/logout', 'AuthController@logout');

$router->get('/register', 'UserController@register', false);
$router->post('/register', 'UserController@register', false);