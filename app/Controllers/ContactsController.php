<?php

//use Slim\Views\Twig as View;
//use Psr\Http\Message\ResponseInterface as Response;
//use Psr\Http\Message\ServerRequestInterface as Request;


namespace App\Controllers;


use Illuminate\Database\Query\Builder;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\App\Models\Contact;
use Slim\Psr7\Request as Request;
use Slim\Psr7\Response as Response;
use Slim\Views\Twig;

class ContactsController extends Controller
{

//    public function index(Request $request, Response $response, View $view)
//    {
//
//        return $view->render($response, 'home.twig');
//    }
//
    public function allData()
    {
        try {
//            $pdo = $this->container->pdo;
//            //$orm = $this->container->orm;
//            $sql = 'SELECT * FROM contacts';
//            foreach ($pdo->query($sql) as $item) {
//                print_r($item);
//            }
            $this->__get('logger')->info("Entrée Page index.twig");
            $query = $this->getAllData('SELECT * FROM contacts');
            //var_dump($query);
            $this->__get('logger')->info('allData Ok!.');

        } catch (PDOException $e) {
            print 'Erreur !: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    public function addContact()
    {

        $setData = $this->setData("INSERT INTO contacts (nom, prenom, email) 
                                           VALUES ('Chazel','Marianne','bernard@morin.fr')");
        var_dump($setData);

        $this->__get('logger')->info('addContact OK!.');

    }

    public function findOne($query)
    {
        $getData = $this->getData($query);
        var_dump($getData);

        $this->__get('logger')->info('findOne : OK!');
    }

}