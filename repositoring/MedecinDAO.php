<?php

namespace repositoring;
use class\Medecin;
use service\PersonneService;
use PDO;

class MedecinDAO
{
    private PDO $db;
    private PersonneService $personneService;

    public function __construct()
    {
        $this->db = getInstance();
    }

    public function insert(Medecin $m)
    {
        $prepared = $this->db->prepare("INSERT INTO Personne (Nom, Prenom, Civilite) VALUES (:nom, :prenom, :civilite);");
        $prepared->execute(array(
            'nom' => $m->getNom(),
            'prenom' => $m->getPrenom(),
            'civilite' => $m->getCivilite()->getName()
        ));
//        $sql = "INSERT INTO Medecin VALUES (".$m->getIdPersonne().");";
//        $this->db->exec($sql);
    }

    public function update(Medecin $m)
    {
        $prepared = $this->db->prepare("UPDATE Personne SET Nom = :nom, Prenom = :prenom, Civilite = :civilite WHERE Id_Personne = :id_personne;");
        $prepared->execute(array(
            'nom' => $m->getNom(),
            'prenom' => $m->getPrenom(),
            'civilite' => $m->getCivilite()->getName(),
            'id_personne' => $m->getIdPersonne()
        ));
        $this->personneService = new PersonneService($m);
        $this->personneService->update();
    }



}