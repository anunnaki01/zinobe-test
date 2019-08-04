<?php

$router = new \Bramus\Router\Router();


//autenticacion


$router->get('/', function () {
    header('location: /login');
    exit();
});

$router->get('/login', '\App\Controllers\Auth\LoginController@login');
$router->post('/login', '\App\Controllers\Auth\LoginController@login');
$router->get('/logout', '\App\Controllers\Auth\LoginController@logout');

//registro
$router->get('/register', '\App\Controllers\Auth\RegisterController@__invoke');
$router->post('/register', '\App\Controllers\Auth\RegisterController@__invoke');

//directorio
$router->get('/admin/directory', '\App\Controllers\Admin\AdminDirectoryController@index');
$router->post('/admin/directory', '\App\Controllers\Admin\AdminDirectoryController@index');

//configuracion de not found y restriccion de session
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo 'Ruta no encontrada';
});
$router->before('GET|POST', '/admin/.*', function () {
    if (!isset($_SESSION['email'])) {
        header('location: /');
        exit();
    }
});


$router->run();