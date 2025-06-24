<?php

namespace App\Utils;

class SystemUtils
{
    public static function registerAdminRoutes($routes, \Closure $callback)
    {
        $routes->group(
            'admin',
            ['namespace' => '\App\Controllers\Admin'],
            static function ($routes) use ($callback) {

                $callback();

            }
        );

    }
}