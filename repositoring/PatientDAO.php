<?php

namespace repositoring;

use class\Patient;

use PDO;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/PDO.php";

class PatientDAO
{
    private static PDO $db;
    private static PatientDAO $instance;

    public static function getInstance()
    {
        if(!isset(self::$db)){
            self::$db = getInstance();
        }
        if (!isset(self::$instance)) {
            self::$instance = new PatientDAO();
        }
        return self::$instance;
    }

    public static function insert(Patient $p)
    {
        $prepared = self::$db->prepare("INSERT INTO Personne (Nom, Prenom, Civilite) VALUES (:nom, :prenom, :civilite);");
        $prepared->execute(array(
            'nom' => $p->getNom(),
            'prenom' => $p->getPrenom(),
            'civilite' => $p->getCivilite()->getName()
        ));
//        $sql = "INSERT INTO Patient VALUES ((SELECT Id_Personne FROM personne WHERE Nom = '".$p->getNom()."' AND Prenom = '".$p->getPrenom()."' ), '".$p->getNumeroDeSecu()."', '".$p->getAdresse()."', '".$p->getDateDeNaisance()->format('Y-m-d')."', '".$p->getLieuDeNaissance()."', 1);";
//        self::$db->exec($sql);
    }

    public static function update(Patient $p)
    {
        $prepared = self::$db->prepare("UPDATE Personne SET Nom = :nom, Prenom = :prenom, Civilite = :civilite WHERE Id_Personne = :id_personne;");
        $prepared->execute(array(
            'nom' => $p->getNom(),
            'prenom' => $p->getPrenom(),
            'civilite' => $p->getCivilite()->getName(),
            'id_personne' => $p->getIdPersonne()
        ));
//        $sql = "UPDATE patient SET Num_Secu = '".$p->getNumeroDeSecu()."', Adresse = '".$p->getAdresse()."', DateNaissance = '".$p->getDateDeNaisance()->format('Y-m-d')."', LieuDeNaissance = '".$p->getLieuDeNaissance()."', Id_Personne_Id_medecinRef = '".$p->getMedecinRefferent()."' WHERE Id_Personne = ".$p->getIdPersonne().";";
//        self::$db->exec($sql);
    }

    public static function delete(int $id_personne)
    {
        $sql = "DELETE FROM Patient WHERE Id_Personne = ".$id_personne.";";
        self::$db->exec($sql);
    }

    public static function selectById(int $id_personne): mixed
    {
        $sql = "SELECT * FROM Patient WHERE Id_Personne = ".$id_personne.";";
        $result =  self::$db->query($sql);
        return $result->fetch();
    }

    public static function selectAll(): array|false
    {
        $sql = "SELECT * FROM Patient;";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function selectAllByMedecin(int $id_medecin): array|false
    {
        $sql = "SELECT * FROM Patient WHERE Id_Personne_Id_medecinRef = ".$id_medecin.";";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

}