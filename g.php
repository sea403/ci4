<?php

require 'vendor/autoload.php';

use OpenApi\Generator;

$openapi = Generator::scan([
    'app/OpenApi.php', // include your global annotations
    // 'app/Controllers'  // include all controllers
]);

header('Content-Type: application/json');
echo $openapi->toJson();
