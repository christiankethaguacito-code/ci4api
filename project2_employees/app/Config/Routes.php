<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Home
$routes->get('/', 'Home::index');

// Employee Routes
$routes->get('/employees', 'EmployeeController::index');
$routes->get('/employees/create', 'EmployeeController::create');
$routes->post('/employees/store', 'EmployeeController::store');
$routes->get('/employees/edit/(:num)', 'EmployeeController::edit/$1');
$routes->post('/employees/update/(:num)', 'EmployeeController::update/$1');
$routes->get('/employees/delete/(:num)', 'EmployeeController::delete/$1');
$routes->get('/employees/view/(:num)', 'EmployeeController::view/$1');

// API Routes
$routes->group('api', function($routes) {
    $routes->get('employees', 'Api\EmployeeApiController::index');
    $routes->get('employees/(:num)', 'Api\EmployeeApiController::show/$1');
    $routes->post('employees', 'Api\EmployeeApiController::create');
    $routes->put('employees/(:num)', 'Api\EmployeeApiController::update/$1');
    $routes->delete('employees/(:num)', 'Api\EmployeeApiController::delete/$1');
});
