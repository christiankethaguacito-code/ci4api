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

// Product Routes
$routes->get('/products', 'ProductController::index');
$routes->get('/products/add', 'ProductController::add');
$routes->post('/products/save', 'ProductController::save');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/update/(:num)', 'ProductController::update/$1');
$routes->get('/products/remove/(:num)', 'ProductController::remove/$1');
$routes->get('/products/details/(:num)', 'ProductController::details/$1');

// API
$routes->group('api', function($routes) {
    $routes->get('products', 'Api\ProductApiController::index');
    $routes->get('products/(:num)', 'Api\ProductApiController::show/$1');
    $routes->post('products', 'Api\ProductApiController::create');
    $routes->put('products/(:num)', 'Api\ProductApiController::update/$1');
    $routes->delete('products/(:num)', 'Api\ProductApiController::delete/$1');
});
