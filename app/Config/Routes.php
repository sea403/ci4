<?php

$routes->get('/', 'Home::index');
$routes->get('/change-lang/(:any)', 'Frontend\SiteController::changeLang/$1');

/** admin routes */
require_once __DIR__ . '/Routes/admin.php';

/** api routes /v1 */
require_once __DIR__ . '/Routes/Api/v1.php';