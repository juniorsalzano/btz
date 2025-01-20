<?php
$router->get('/', 'HomeController@index');

$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@login');

$router->get('/logout', 'AuthController@logout');

$router->get('/register', 'UserController@register');
$router->post('/register', 'UserController@register');
