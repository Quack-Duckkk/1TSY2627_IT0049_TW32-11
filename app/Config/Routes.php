<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public pages (no login needed)
$routes->get('/', 'Pages::index');
$routes->get('about', 'Pages::about');

// Auth routes (must stay OUTSIDE the filter group)
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');

// Protected pages (login required)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->post('logout', 'Auth::logout');

    // Customers
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::new');
    $routes->post('customers', 'Customers::create');
    $routes->get('customers/(:num)/edit', 'Customers::edit/$1');
    $routes->post('customers/(:num)', 'Customers::update/$1');
    $routes->post('customers/(:num)/delete', 'Customers::delete/$1');

    // Users
    $routes->get('users', 'Users::index');
    $routes->get('users/new', 'Users::new');
    $routes->post('users', 'Users::create');
    $routes->get('users/(:num)/edit', 'Users::edit/$1');
    $routes->post('users/(:num)', 'Users::update/$1');
    $routes->post('users/(:num)/delete', 'Users::delete/$1');

    // Products
    $routes->get('products', 'Products::index');
    $routes->get('products/new', 'Products::new');
    $routes->post('products', 'Products::create');
    $routes->get('products/(:num)/edit', 'Products::edit/$1');
    $routes->post('products/(:num)', 'Products::update/$1');
    $routes->post('products/(:num)/archive', 'Products::archive/$1');
    $routes->post('products/(:num)/restore', 'Products::restore/$1');

    // Sales
    $routes->get('sales/record', 'Sales::new');
    $routes->post('sales', 'Sales::create');
    $routes->get('sales', 'Sales::history');
});