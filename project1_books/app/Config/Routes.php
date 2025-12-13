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

// Home route
$routes->get('/', 'Home::index');

// Book CRUD Routes
$routes->get('/books', 'BookController::index');
$routes->get('/books/create', 'BookController::create');
$routes->post('/books/store', 'BookController::store');
$routes->get('/books/edit/(:num)', 'BookController::edit/$1');
$routes->post('/books/update/(:num)', 'BookController::update/$1');
$routes->get('/books/delete/(:num)', 'BookController::delete/$1');
$routes->get('/books/show/(:num)', 'BookController::show/$1');

// API Routes for Books
$routes->group('api', function($routes) {
    $routes->get('books', 'Api\BookApiController::index');
    $routes->get('books/(:num)', 'Api\BookApiController::show/$1');
    $routes->post('books', 'Api\BookApiController::create');
    $routes->put('books/(:num)', 'Api\BookApiController::update/$1');
    $routes->delete('books/(:num)', 'Api\BookApiController::delete/$1');
});
