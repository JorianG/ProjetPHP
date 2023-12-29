<?php

namespace service;

use class\Personne;
use repositoring\PersonneDAO;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/repositoring/PersonneDAO.php";

class PersonneService
{
    private PersonneDAO $personneDAO;
    private Personne $personne;

    public function __construct()
    {
        $this->personneDAO = PersonneDAO::getInstance();

    }

    public function insert(Personne $personne)
    {
        $this->personneDAO->insert($personne);
    }

    public function update(Personne $personne)
    {
        $this->personneDAO->update($personne);
    }

    public function delete(int $id_personne)
    {
        $this->personneDAO->delete($id_personne);
    }

    public function selectById(int $id): Personne
    {
        return Personne::newFromRow($this->personneDAO->selectById($id));
    }

    public function selectAll(): array
    {
        return Personne::newFromArray($this->personneDAO->selectAll());
    }
}