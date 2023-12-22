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
        $this->db = connexion();
    }

    public function insert(Medecin $m)
    {
        $sql = "INSERT INTO Medecin VALUES (".$m->getIdPersonne().");";
        $this->db->exec($sql);
    }

    public function update(Medecin $m)
    {
        $this->personneService = new PersonneService($m);
        $this->personneService->update();
    }



}