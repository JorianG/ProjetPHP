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

    public function __construct(Personne $personne)
    {
        $this->personneDAO = PersonneDAO::getInstance();
        $this->personne = $personne;
    }

    public function insert()
    {
        $this->personneDAO->insert($this->personne);
    }

    public function update()
    {
        $this->personneDAO->update($this->personne);
    }

    public function delete()
    {
        $this->personneDAO->delete($this->personne);
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