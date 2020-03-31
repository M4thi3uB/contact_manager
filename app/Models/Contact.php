<?php


namespace Slim\App\Models;

use Slim\App;
use Illuminate\Database\Capsule;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    protected $connection = 'db_contacts'; //regarder comment définir par défaut une connexion
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //$connections = $this->app['settings']['db_contacts'];

//Message: Database [db_contact] not configured
//File: vendor\illuminate\database\DatabaseManager.php
//Line: 152

    //Les champs qui ne peuvent pas être mis à jour
    //protected $guarded = [''];

    //Les champs qui peuvent l'être
    protected $fillable = ['*'];
    protected $container;

//    public function __construct(array $attributes = [])
//    {
//        parent::__construct($attributes);
//    }
//
//    public function getAllConfig()
//    {
//        $arrCfg = $this->attributes;
//        $settings = $this->container['settings']['db_contact'];
//
//        var_dump($settings);
//    }
}