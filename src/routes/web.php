<?php

$router->get('/', 'Controller@home', false);
$router->get('/home', 'Controller@home', false);

$router->get('/login', 'AuthController@login', false);
$router->post('/login', 'AuthController@login', false);

$router->get('/logout', 'AuthController@logout');

$router->get('/register', 'UserController@register', false);
$router->post('/register', 'UserController@register', false);

$router->get('/welcome', 'Controller@welcome', true); 
$router->get('/edit_user', 'Controller@editUser', true);
$router->post('/update_user', 'Controller@updateUser', true);