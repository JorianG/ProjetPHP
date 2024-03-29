<?php

namespace repositoring;

use class\RDV;

use PDO;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/RDV.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/PDO.php";

class RDVDAO
{
    private static PDO $db;
    private static RDVDAO $instance;

    public static function getInstance(): RDVDAO
    {
        if(!isset(self::$db)){
            self::$db = getInstance();
        }
        if (!isset(self::$instance)) {
            self::$instance = new RDVDAO();
        }
        return self::$instance;
    }

    public static function insert(RDV $r): void
    {

        //TODO : SQL Injection protection please
        $sql = "INSERT INTO RDV (
                 Id_Personne_Id_Patient, 
                 Id_Personne_id_medecin, 
                 DateHeure, 
                 DureeEnM) VALUES ('"
            .$r->getPatient()->getIdPersonne() ."', '"
            .$r->getMedecin()->getIdPersonne() ."', '"
            .$r->getDateHeure()->format('Y-m-d H:i')."', '"
            .$r->getDureeEnMinute()."');";
        self::$db->exec($sql);
    }

    public static function update(RDV $r): void
    {
        // TODO : SQL Injection protection please
        $sql = "UPDATE RDV SET 
                Id_Personne_Id_Patient = '".$r->getPatient()->getIdPersonne()."', 
                Id_Personne_id_medecin = '".$r->getMedecin()->getIdPersonne()."', 
                DateHeure = '".$r->getDateHeure()->format('Y-m-d H:i')."', 
                DureeEnM = '".$r->getDureeEnMinute()."' 
                WHERE Id_RDV = ".$r->getIdRDV().";";
        self::$db->exec($sql);
    }

    public static function delete(int $id_RDV): void
    {
        $sql = "DELETE FROM RDV WHERE Id_RDV = ".$id_RDV.";";
        self::$db->exec($sql);
    }

    public static function selectById(int $id_RDV): mixed
    {
        $sql = "SELECT * FROM RDV WHERE Id_RDV = ".$id_RDV.";";
        $result =  self::$db->query($sql);
        return $result->fetch();
    }

    public static function isSet(int $id_rdv): bool
    {
        $sql = "SELECT * FROM RDV WHERE Id_RDV = ".$id_rdv.";"; // TODO try catch
        $result =  self::$db->query($sql);
        return $result->fetch() != null;
    }

    public static function selectAll(): array|false
    {
        $sql = "SELECT * FROM RDV;";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function selectAllByMedecin(int $id_medecin): array|false
    {
        $sql = "SELECT * FROM RDV WHERE Id_Personne_id_medecin = ".$id_medecin.";";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function selectAllByPatient(int $id_patient): array|false
    {
        $sql = "SELECT * FROM RDV WHERE Id_Personne_Id_Patient = ".$id_patient.";";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function selectAllSortedByDate(): array|false
    {
        $sql = "SELECT * FROM RDV ORDER BY DateHeure desc;";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }
}