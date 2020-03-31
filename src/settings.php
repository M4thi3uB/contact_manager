<?php


return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'view' => [
            'template_path' => __DIR__ . '/../templates/',
            'twig_path' => __DIR__ . '/../app/Views/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

//        //ORM Eloquent
//        'eloquent'=>[
//            'eloquent_path' => __DIR__ . '../vendor/reliese/laravel/src/Coders/CodersServiceProvider::class'
//        ],

        //database settings
        'db_contacts'=>[
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'contact_manager',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' =>'',
        ]
    ],


];
