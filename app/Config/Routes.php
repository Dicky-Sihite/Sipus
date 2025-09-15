<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Books::index');

// Books routes
$routes->group('books', static function ($routes) {
    $routes->get('/', 'Books::index');
    $routes->get('detail/(:num)', 'Books::detail/$1');
    $routes->get('search', 'Books::search');
    $routes->get('location/(:num)', 'Books::location/$1');
});

// Admin routes (for future use)
$routes->group('admin', static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('books', 'Admin\Books::index');
    $routes->get('books/create', 'Admin\Books::create');
    $routes->post('books/store', 'Admin\Books::store');
    $routes->get('books/edit/(:num)', 'Admin\Books::edit/$1');
    $routes->post('books/update/(:num)', 'Admin\Books::update/$1');
    $routes->delete('books/delete/(:num)', 'Admin\Books::delete/$1');
});

// API routes (for AJAX requests)
$routes->group('api', ['namespace' => 'App\Controllers\API'], static function ($routes) {
    $routes->get('books', 'Books::index');
    $routes->get('books/(:num)', 'Books::show/$1');
    $routes->get('books/search/(:any)', 'Books::search/$1');
});