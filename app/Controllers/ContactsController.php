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
use Slim\Psr7\Request as Request;
use Slim\Psr7\Response as Response;
use App\Models\Contact;
use Slim\Views\Twig;

class ContactsController extends Controller
{

//    public function index(Request $request, Response $response, View $view)
//    {
//
//        return $view->render($response, 'home.twig');
//    }
//
    public function all_contacts()
    {
        try {
            $pdo = $this->container->pdo;
            $sql = 'SELECT * FROM contacts';
            foreach ($pdo->query($sql) as $item) {
                print_r($item);
            }

            //var_dump($pdo);
        } catch (PDOException $e) {

            print 'Erreur !: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    public function listContact()
    {

        $contacts = Contact::all();

        foreach ($contacts as $contact) {
            $nom = $contact->nom;
            var_dump($nom);
        }

    }

    public function findOne()
    {
        $contact = Contact::find(1);
        return $contact->toJson(JSON_PRETTY_PRIT);
    }

}