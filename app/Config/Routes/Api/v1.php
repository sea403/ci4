<?php

$routes->group(
    'api/v1',
    ['namespace' => '\App\Controllers\Api\V1'],
    static function ($routes) {
        $routes->post('register', 'AuthController::register');
        $routes->post('login', 'AuthController::login');

        $routes->group('', ['filter' => 'jwt'], static function ($routes) {
            $routes->get('profile', 'AuthController::profile');
            
            $routes->get('posts', 'BlogPostController::index');
        });

    }
);
