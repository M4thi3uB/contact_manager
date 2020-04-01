<?php

use App\Controllers\SystemController;
use Slim\App;

use App\Models\ContactEdit;
use App\Controllers\Controller;
use Slim\App\Models\WidgetController;

//return function (App $app) {
$container = $app->getContainer();

// view renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['view'];
    return new \Slim\Views\PhpRenderer($settings['template_path']);
};

// Register component Twig on container
$container['twig_view'] = function ($container) {
    $settings = $container->get('settings')['view'];
    //$dir = dirname(__DIR__);
    $view = new \Slim\Views\Twig($settings['twig_path']);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

//    $basePath = rtrim(str_replace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
//    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};



// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

//PDO Database
$container['pdo'] = function ($c) {
    try {
        $settings = $c->get('settings')['db_contacts'];
        $dsn = 'mysql:host=' . $settings['host'] . ';dbname=' . $settings['database'];
        $pdo = new PDO($dsn, $settings['username'], $settings['password']);

        //PDO::ATTR_ERRMODE : rapport d'erreurs.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;

    } catch (PDOException $e) {

        print 'Erreur : ' . $e->getMessage() . '<br>';
        die();
    }
};

//ORM Eloquent Configuration
//$container['db_contacts'] = function ($container) {
//$capsule = new Illuminate\Database\Capsule\Manager;
//$capsule->addConnection($container['settings']['db_contacts'], 'contact_manager');
//$capsule->setAsGlobal();
//$capsule->bootEloquent();
//return $capsule;

//};
$container['orm'] = function ($container) {
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db_contacts'], 'contact_manager');
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};


$container[''] = function ($c) {
    $view = $c->get('view');
    $logger = $c->get('logger');
    $table = $c->get('settings')['db_contacts']->table('contacts');
    return new WidgetController($view, $logger, $table);
};

// -----------------------------------------------------------------------------
// Model factories
// -----------------------------------------------------------------------------
$container['cfgModel'] = function ($container) {
    $settings = $container->get('settings');
    return new App\Models\Contact($container->get('pdo'));
};


// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------

$container[Controller::class] = function ($container) {
    $view = $container->get('view');
    $logger = $container->get('logger');
    return new Controller($view, $logger);
};

$container[SystemController::class] = function ($container) {
    $logger = $container->get('logger');
    $cfgModel = $container->get('cfgModel');
    // $cfgModel = $container->get('cfgModelFPDO');
    // $cfgModel = $container->get('cfgModelMock');
    return new SystemController($logger, $cfgModel);
};