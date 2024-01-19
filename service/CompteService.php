<?php

namespace service;
use class\Compte;
use repositoring\CompteDAO;

include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetPHP/class/Compte.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetPHP/repositoring/CompteDAO.php";



class CompteService
{

    private CompteDAO $compteDAO;

    function __construct()
    {   
        $this->compteDAO = CompteDAO::getInstance();
    }

    function insert(Compte $c): void
    {
        $this->compteDAO->insert($c);
    }

    function accessGranted(Compte $c): bool
    {
        return $this->compteDAO->accessGranted($c);
    }
}