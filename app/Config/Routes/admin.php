<?php

use App\Utils\SystemUtils;

SystemUtils::registerAdminRoutes($routes, function () use ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('profile', 'AdminController::profile');

    $routes->get('user/index', 'UserController::index');
    $routes->get('user/add', 'UserController::add');
    $routes->post('user/store', 'UserController::store');
    $routes->get('user/(:num)/edit', 'UserController::edit/$1');
    $routes->get('user/(:num)/delete', 'UserController::delete/$1');
    $routes->post('user/(:num)/update', 'UserController::update/$1');

    $routes->get('language/index', 'LanguageController::index');
    $routes->post('language/store', 'LanguageController::store');
    $routes->post('language/(:num)/update', 'LanguageController::update/$1');
});
