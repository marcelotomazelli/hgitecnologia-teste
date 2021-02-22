<?php

ob_start();

require __DIR__ . '/vendor/autoload.php';

/**
 * BOOTSTRAP
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ':');

/**
 * WEB ROUTES
 */
$route->namespace('Source\App');
$route->get('/', 'WebController:home');
$route->get('/cadastro', 'WebController:register');
$route->get('/login', 'WebController:login');
$route->get('/perfil', 'WebController:profile');

/** auth */
$route->post('/cadastro', 'WebController:register');
$route->post('/login', 'WebController:login');
$route->post('/perfil', 'WebController:profile');
$route->get('/sair', 'WebController:logout');

/** optin */
$route->get('/bem-vindo', 'WebController:welcome');
$route->get('/dados-atualizados', 'WebController:updated');

/**
 * ADMIN ROUTES
 */
$route->namespace('Source\App')->group('/admin');
$route->get('/', 'AdminController:dash');
$route->get('/usuarios', 'AdminController:users');

/** search */
$route->post('/usuarios', 'AdminController:users');

/** remove */
$route->post('/remove-user', 'AdminController:removeUser');

/**
 * ERROR ROUTES
 */
$route->namespace('Source\App')->group('/erro');
$route->get('/{error}', 'WebController:error');

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/erro/{$route->error()}");
}

ob_end_flush();
