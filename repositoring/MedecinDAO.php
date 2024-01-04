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
        $this->db->exec($sql);
    }

    public function update(Medecin $m)
    {
        $sql = "UPDATE Medecin SET specialite = '".$m->getSpecialite()."' WHERE idPersonne = '".$m->getIdPersonne()."';";
        $this->db->exec($sql);
    }

    public function delete(Medecin $m)
    {
        $sql = "DELETE FROM Medecin WHERE idPersonne = '".$m->getIdPersonne()."';";
        $this->db->exec($sql);
    }

    public function selectById(int $id_personne): mixed
    {
        $sql = "SELECT * FROM Medecin WHERE idPersonne = '".$id_personne."';";
        $result =  $this->db->query($sql);
        return $result->fetch();
    }

    public function selectAll(): array|false
    {
        $sql = "SELECT * FROM Medecin;";
        $result =  $this->db->query($sql);
        return $result->fetchAll();
    }


}