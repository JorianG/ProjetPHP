<?php

namespace repositoring;
use class\Medecin;
use service\PersonneService;
use PDO;

class MedecinDAO
{
    private static PDO $db;
    private static MedecinDAO $instance;

    

    public static function getInstance()
    {
        if(!isset(self::$db)){
            self::$db = getInstance();
        }
        if (!isset(self::$instance)) {
            self::$instance = new MedecinDAO();
        }
        return self::$instance;
    }

    public static function insert(Medecin $m): void
    {
        $sql = "INSERT INTO Medecin VALUES ('".$m->getIdPersonne()."', '".$m->getSpecialite()."' );";
        self::$db->exec($sql);
    }

    public static function update(Medecin $m): void
    {
        $sql = "UPDATE Medecin SET specialite = '".$m->getSpecialite()."' WHERE id_Personne = '".$m->getIdPersonne()."';";
        self::$db->exec($sql);
    }

    public static function delete(int $id_personne): void
    {
        $sql = "DELETE FROM Medecin WHERE id_Personne = ".$id_personne.";";
        self::$db->exec($sql);
    }

    public static function getById(int $id_personne): mixed
    {
        $sql = "SELECT * FROM Medecin, Personne WHERE Medecin.Id_Personne = ".$id_personne." AND Medecin.Id_Personne = Personne.Id_Personne;";
        $result =  self::$db->query($sql);
        return $result->fetch();
    }

    public static function getAll(): array|false
    {
        $sql = "SELECT * FROM Medecin, Personne WHERE Medecin.Id_Personne = Personne.Id_Personne";
        $result =  self::$db->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getBySpecialite(string $specialite): array|false
    {
        $sql = "SELECT * FROM Medecin WHERE specialite = '".$specialite."';";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function selectAllByPatient(int $id_patient): array|false
    {
        $sql = "SELECT * FROM Medecin WHERE idPersonne = (SELECT Id_Personne_Id_medecinRef FROM Patient WHERE Id_Personne = '".$id_patient."');";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public static function isSet(int $id_personne): bool
    {
        $sql = "SELECT * FROM Medecin WHERE id_Personne = ".$id_personne.";";
        $result =  self::$db->query($sql);
        return $result->fetch() != null;
    }

    public static function getPatients(int $id_medecin): array|false
    {
        $sql = "SELECT * FROM Patient WHERE Id_Personne_Id_medecinRef = ".$id_medecin.";";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }
}