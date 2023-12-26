<?php

namespace repositoring;

use class\Personne;
use PDO;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/PDO.php";

class PersonneDAO
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getInstance();
    }

    public function insert(Personne $p)
    {
        //TODO : SQL Error
        //TODO : SQL Injection protection please
        $sql = "INSERT INTO Personne (Nom, Prenom, Civilite) VALUES ('".$p->getNom()."', '".$p->getPrenom()."', '".$p->getCivilite()->getName()."');";
        $this->db->exec($sql);
    }

    public function update(Personne $p)
    {
        $sql = "UPDATE Personne SET Nom = '".$p->getNom()."', Prenom = '".$p->getPrenom()."', Civilite = '".$p->getCivilite()->getName()."' WHERE Id_Personne = ".$p->getIdPersonne().";";
        $this->db->exec($sql);
    }

    public function delete(Personne $p)
    {
        $sql = "DELETE FROM Personne WHERE Id_Personne = ".$p->getIdPersonne().";";
        $this->db->exec($sql);
    }

    public function selectById(int $id): mixed
    {
        $sql = "SELECT * FROM Personne WHERE Id_Personne = ".$id.";";
        $result = $this->db->query($sql);
        return $result->fetch();
    }

    public function selectAll(): array|false
    {
        $sql = "SELECT * FROM Personne;";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

    public function getLastId(): int
    {
        $sql = "SELECT MAX(Id_Personne) FROM Personne;";
        return $this->db->query($sql)->fetch()[0];
    }
}