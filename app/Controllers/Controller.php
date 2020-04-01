<?php


namespace App\Controllers;


class Controller
{
    protected $container;
    protected $user;
    protected $view;
    protected $logger;
    private $pdo = null;

    public function __construct($container)
    {
        $this->container = $container;
        $this->pdo = $this->container->pdo;

    }

    // Permet d'éviter la synthaxe $this->$container->view par $this->$view
    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    //Returns a unique result from the Database
    public function getData(string $query, array $params = [])
    {
        $PDOStatement = $this->pdo->prepare($query);
        $PDOStatement->execute($params);

        return $PDOStatement->fetch();
    }

    //Returns many results from the Database
    public function getAllData(string $query, array $params = [])
    {
        $PDOStatement = $this->pdo->prepare($query);
        $PDOStatement->execute($params);

        return $PDOStatement->fetchAll();
    }

    //Execute an action to the Database
    public function setData(string $query, array $params = [])
    {
        $PDOStatement = $this->pdo->prepare($query);

        return $PDOStatement->execute($params);
    }



}