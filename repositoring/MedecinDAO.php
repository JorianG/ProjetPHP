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

    public function insert(Medecin $m)
    {
        $sql = "INSERT INTO Medecin VALUES ('".$m->getIdPersonne()."', '".$m->getSpecialite()."' );";
        self::$db->exec($sql);
    }

    public function update(Medecin $m)
    {
        $sql = "UPDATE Medecin SET specialite = '".$m->getSpecialite()."' WHERE idPersonne = '".$m->getIdPersonne()."';";
        self::$db->exec($sql);
    }

    public function delete(Medecin $m)
    {
        $sql = "DELETE FROM Medecin WHERE idPersonne = '".$m->getIdPersonne()."';";
        self::$db->exec($sql);
    }

    public function getById(int $id_personne): mixed
    {
        $sql = "SELECT * FROM Medecin, Personne WHERE Medecin.Id_Personne = ".$id_personne." AND Medecin.Id_Personne = Personne.Id_Personne;";
        $result =  self::$db->query($sql);
        return $result->fetch();
    }

    public function getAll(): array|false
    {
        $sql = "SELECT * FROM Medecin, Personne WHERE Medecin.Id_Personne = Personne.Id_Personne";
        $result =  self::$db->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getBySpecialite(string $specialite): array|false
    {
        $sql = "SELECT * FROM Medecin WHERE specialite = '".$specialite."';";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }

    public function selectAllByPatient(int $id_patient): array|false
    {
        $sql = "SELECT * FROM Medecin WHERE idPersonne = (SELECT Id_Personne_Id_medecinRef FROM Patient WHERE Id_Personne = '".$id_patient."');";
        $result =  self::$db->query($sql);
        return $result->fetchAll();
    }
    


}