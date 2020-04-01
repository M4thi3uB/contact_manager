<?php


namespace App\Controllers;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

class IndexController extends Controller
{

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function index(Request $request, Response $response, $args)
    {

        $this->__get('twig_view')->render($response, 'index.twig');
        return $response;
    }

    public function checkAuth(Request $request, Response $response, $args)
    {
        try {
//            $request->getRequestTarget();
//            $method = $request->getMethod();
//            var_dump($method);
        } catch (PDOException $e) {
            print 'Erreur : ' . $e->getMessage() . '<br>';
            die();
        }
    }


}