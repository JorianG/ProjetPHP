<?php

namespace repositoring;

use class\Personne;
use PDO;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/PDO.php";

class PersonneDAO
{
    private static PDO $db;
    private static PersonneDAO $instance;

    public static function getInstance()
    {
        if(!isset(self::$db)){
           self::$db = getInstance();
        }
        if (!isset(self::$instance)) {
            self::$instance = new PersonneDAO();
        }
        return self::$instance;
    }

    public static function insert(Personne $p)
    {
        //TODO : SQL Error
        $prepared = self::$db->prepare("INSERT INTO Personne (Nom, Prenom, Civilite) VALUES (:nom, :prenom, :civilite);");
        $prepared->execute(array(
            'nom' => $p->getNom(),
            'prenom' => $p->getPrenom(),
            'civilite' => $p->getCivilite()->getName()
        ));
//        $sql = "INSERT INTO Personne (Nom, Prenom, Civilite) VALUES ('".$p->getNom()."', '".$p->getPrenom()."', '".$p->getCivilite()->getName()."');";
//       self::$db->exec($sql);
    }

    public static function update(Personne $p)
    {
        $prepared = self::$db->prepare("UPDATE Personne SET Nom = :nom, Prenom = :prenom, Civilite = :civilite WHERE Id_Personne = :id_personne;");
        $prepared->execute(array(
            'nom' => $p->getNom(),
            'prenom' => $p->getPrenom(),
            'civilite' => $p->getCivilite()->getName(),
            'id_personne' => $p->getIdPersonne()
        ));
//        $sql = "UPDATE Personne SET Nom = '".$p->getNom()."', Prenom = '".$p->getPrenom()."', Civilite = '".$p->getCivilite()->getName()."' WHERE Id_Personne = ".$p->getIdPersonne().";";
//        self::$db->exec($sql);
    }

    public static function delete(int $id_personne)
    {
        $sql = "DELETE FROM Personne WHERE Id_Personne = ".$id_personne.";";
        self::$db->exec($sql);
    }

    public static function selectById(int $id): mixed
    {
        $sql = "SELECT * FROM Personne WHERE Id_Personne = ".$id.";";
        $result = self::$db->query($sql);
        return $result->fetch();
    }

    public static function selectAll(): array|false
    {
        $sql = "SELECT * FROM Personne;";
        $result = self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function getLastId(): int
    {
        $sql = "SELECT MAX(Id_Personne) FROM Personne;";
        return self::$db->query($sql)->fetch()[0];
    }
}