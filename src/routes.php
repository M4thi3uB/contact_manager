<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Controllers\ContactsController;


//return function (App $app) {
$container = $app->getContainer();


$app->get('/', function (Request $request, Response $response, array $args) use ($container) {
    // Sample log message
    //$container->get('logger')->info("Slim-Skeleton '/' route");

    // Render index view
    return $container->get('view')->render($response, 'index.phtml', $args);
});

// Render Twig template in route
//$app->get('/home}', function (Request $request, Response $response, array $args) use ($container) {
//
//    return $container->get('view')->render($response, 'home.twig');
//});

$app->get('/home', function (Request $request, Response $response, array $args) use ($container) {
    return $container->get('twig_view')->render($response, 'base.twig', $args);
});

$app->get('/index/twig', function (Request $request, Response $response, array $args) use ($container) {

    return $container->get('twig_view')->render($response, 'index.twig', $args);
});

//Route IndexController
$app->get('/index', '\App\Controllers\IndexController:index');
$app->get('/index/', '\App\Controllers\IndexController:checkAuth');

//Contact

//Route ContactsController -> all_contacts
$app->get('/contact', '\App\Controllers\ContactsController:addContact');
$app->get('/contact/all', '\App\Controllers\ContactsController:allData');

//$app->get('/contact', '\App\Controllers\ContactsController:all_contacts');

$app->get('/pdo', function (Request $request, Response $response, array $args) use ($container) {

    $myPdo = $this->get('pdo');
    $myOrm = $this->get('orm');
    // Render index view
    var_dump($myPdo);
    var_dump($myOrm);
    return $response;
});

$app->get('/sys/version', 'App\Controllers\SystemController:getVersion')
    ->setName('api_get_app_version');