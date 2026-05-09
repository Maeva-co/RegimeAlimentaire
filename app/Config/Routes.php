<?php

namespace Config;

$routes = Services::routes();

$routes->setAutoRoute(false);

// Routes publiques
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'AuthController::loginForm');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/hero', 'HomeController::hero');
$routes->get('/regime/perdre', 'RegimeController::perdre');
$routes->get('/regime/gagner', 'RegimeController::gagner');
$routes->get('/regime/imc', 'RegimeController::imc');
$routes->post('/regime/perdre/pdf', 'RegimeController::exportPerdrePdf');
$routes->post('/regime/gagner/pdf', 'RegimeController::exportGagnerPdf');
$routes->get('/code/redeem', 'CodeController::redeemForm');
$routes->post('/code/redeem', 'CodeController::redeem');

// Back Office Admin
$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->resource('regimes', ['controller' => 'Admin\RegimeController']);
    $routes->resource('sports', ['controller' => 'Admin\SportController']);
    $routes->resource('codes', ['controller' => 'Admin\CodeController']);
    $routes->resource('parametres', ['controller' => 'Admin\ParametreController']);
});