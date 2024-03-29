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

    public static function getInstance(): PatientDAO
    {
        if(!isset(self::$db)){
            self::$db = getInstance();
        }
        if (!isset(self::$instance)) {
            self::$instance = new PatientDAO();
        }
        return self::$instance;
    }

    public static function insert(Patient $p): void
    {
        //TODO : SQL Injection protection please
        $med = $p->getMedecinRefferent();
        $sql = "INSERT INTO Patient VALUES ('".$p->getIdPersonne()."', '".$p->getNumeroDeSecu()."', '".$p->getAdresse()."', '".$p->getDateDeNaisance()->format('Y-m-d')."', '".$p->getLieuDeNaissance()."', ".$med->getIdPersonne().");";
        self::$db->exec($sql);
    }

    public static function update(Patient $p): void
    {
        $med = $p->getMedecinRefferent();
        $sql = "UPDATE Patient SET Num_Secu = '".$p->getNumeroDeSecu()."', Adresse = '".$p->getAdresse()."', DateNaissance = '".$p->getDateDeNaisance()->format('Y-m-d')."', LieuDeNaissance = '".$p->getLieuDeNaissance()."', Id_Personne_Id_medeciRef = ".$med->getIdPersonne()." WHERE Id_Personne = ".$p->getIdPersonne().";";
        self::$db->exec($sql);
    }

    public static function delete(int $id_personne): void
    {
        $sql = "DELETE FROM Patient WHERE Id_Personne = ".$id_personne.";";
        self::$db->exec($sql);
    }

    public static function selectById(int $id_personne): mixed
    {
        $sql = "SELECT * FROM Patient , Personne WHERE Patient.Id_Personne = ".$id_personne." AND Patient.Id_Personne = Personne.Id_Personne;";
        $result =  self::$db->query($sql);
        return $result->fetch();
    }

    public static function selectAll(): array|false
    {
        $sql = "SELECT * FROM Patient, Personne WHERE Patient.Id_Personne = Personne.Id_Personne;";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function selectAllByMedecin(int $id_medecin): array|false
    {
        $sql = "SELECT * FROM Patient WHERE Id_Personne_Id_medeciRef = ".$id_medecin.";";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function getMedecinRefferent(int $id_patient): mixed
    {
        $sql = "SELECT Id_Personne_Id_medeciRef FROM Patient WHERE Patient.Id_Personne = ".$id_patient.";";
        $result =  self::$db->query($sql);
        return $result->fetch();
    }

    public static function resetMedecinTraitant(int $id_medecin)
    {
        $sql = "UPDATE Patient SET Id_Personne_Id_medeciRef = NULL WHERE Id_Personne_Id_medeciRef = ".$id_medecin.";";
        self::$db->exec($sql);
    }

    public static function isSet(int $id_personne): bool
    {
        $sql = "SELECT * FROM Patient WHERE Id_Personne = ".$id_personne.";"; // TODO try catch
        $result =  self::$db->query($sql);
        return $result->fetch() != null;
    }
}