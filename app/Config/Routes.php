<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// vers liste d'etudiant
$routes->get('/students', 'StudentController::index');
