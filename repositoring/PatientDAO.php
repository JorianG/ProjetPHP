<?php

namespace repositoring;

use class\Patient;

use PDO;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/PDO.php";

class PatientDAO
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getInstance();
    }

    public function insert(Patient $p)
    {
        //TODO : SQL Injection protection please
        //$sql = "INSERT INTO Patient VALUES ((SELECT Id_Personne FROM personne WHERE Nom = ? AND Prenom = ?), '".$p->getNumeroDeSecu()."', '".$p->getAdresse()."', '".$p->getDateDeNaisance()->format('Y-m-d')."', '".$p->getLieuDeNaissance()."', '".$p->getMedecinRefferent()."');";
        $sql = "INSERT INTO Patient VALUES ((SELECT Id_Personne FROM personne WHERE Nom = '".$p->getNom()."' AND Prenom = '".$p->getPrenom()."' ), '".$p->getNumeroDeSecu()."', '".$p->getAdresse()."', '".$p->getDateDeNaisance()->format('Y-m-d')."', '".$p->getLieuDeNaissance()."', 1);";
        $this->db->exec($sql);
    }

    public function update(Patient $p)
    {
        $sql = "UPDATE patient SET Num_Secu = '".$p->getNumeroDeSecu()."', Adresse = '".$p->getAdresse()."', DateNaissance = '".$p->getDateDeNaisance()->format('Y-m-d')."', LieuDeNaissance = '".$p->getLieuDeNaissance()."', Id_Personne_Id_medecinRef = '".$p->getMedecinRefferent()."' WHERE Id_Personne = ".$p->getIdPersonne().";";
        $this->db->exec($sql);
    }

    public function delete(int $id_personne)
    {
        $sql = "DELETE FROM Patient WHERE Id_Personne = ".$id_personne.";";
        $this->db->exec($sql);
    }

    public function selectById(int $id_personne): mixed
    {
        $sql = "SELECT * FROM Patient WHERE Id_Personne = ".$id_personne.";";
        $result = $this->db->query($sql);
        return $result->fetch();
    }

    public function selectAll(): array|false
    {
        $sql = "SELECT * FROM Patient;";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

    public function selectAllByMedecin(int $id_medecin): array|false
    {
        $sql = "SELECT * FROM Patient WHERE Id_Personne_Id_medecinRef = ".$id_medecin.";";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

}