<?php



require '../vendor/autoload.php';



use Illuminate\Database\Capsule\Manager;

use Slim\Factory\AppFactory;



$app = AppFactory::create();


$config = require '../src/config.php';


return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'database',
            'username' => 'user',
            'password' => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];




$routes= require '../src/routes.php';

$routes($app);



$app->run();