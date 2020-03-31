<?php


namespace App\Controllers;


class Controller
{
    protected $container;
    protected $user;
    protected $view;
    protected $logger;


    public function __construct($container)
    {
        $this->container = $container;

    }

//    // Permet d'éviter la synthaxe $this->$container->view par $this->$view
    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

}