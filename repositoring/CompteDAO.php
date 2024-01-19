<?php

namespace repositoring;

use class\Compte;

class CompteDAO
{
    private static PDO $db;
    private static CompteDAO $instance;

    public static function getInstance(): CompteDAO
    {
        if(!isset(self::$db)){
            self::$db = getInstance();
        }
        if (!isset(self::$instance)) {
            self::$instance = new CompteDAO();
        }
        return self::$instance;
    }

    public static function insert(Compte $c): void
    {
        //TODO : SQL Injection protection please
        $sql = "INSERT INTO Compte (Login, Mdp) VALUES ('".$c->getLogin()."', '".$c->getMdp()."', '".$c->getIdPersonne()."');";
        self::$db->exec($sql);
    }


    public static function accessGranted(Compte $c): bool
    {
        //TODO : SQL Injection protection please
        $sql = "Select * from COMPTE WHERE Id_Compte = ".$c->getLogin()." AND ".$c->getMdp().";";
        $result = self::$db->exec($sql);
        if (!$result->fetchAll()) {
            return false;
        }
        return true;
    }
}