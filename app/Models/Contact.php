<?php


namespace Slim\App\Models;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Illuminate\Database\Capsule;
use Illuminate\Database\Eloquent\Model;



class Contact extends Model
{
    protected $connection = 'contact_manager'; //regarder comment définir par défaut une connexion
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $pdo;
    protected $logger;
    //$connections = $this->app['settings']['db_contacts'];

//Message: Database [db_contact] not configured
//File: vendor\illuminate\database\DatabaseManager.php
//Line: 152

    //Les champs qui ne peuvent pas être mis à jour
    //protected $guarded = [''];

    //Les champs qui peuvent l'être
    protected $fillable = ['*'];
    protected $container;

    public function __construct($container)
    {
        parent::__construct($container);
    }

//    public function getConfig(Request $request, Response $response, $args){
//        $data = [];
//        $this->logger->info('Action : Configuration From DB');
//        try {
//            $cfg = $this->container->cfgModel();
//            var_dump($cfg);
//        } catch (\Exception $e) {
//            echo $e->getMessage();
//            $this->logger->error($e->getMessage());
//            die;
//        }
//    }

}