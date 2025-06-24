<?php

$routes->get('/', 'Home::index');

/** admin routes */
require_once __DIR__ . '/Routes/admin.php';

/** api routes /v1 */
require_once __DIR__ . '/Routes/Api/v1.php';