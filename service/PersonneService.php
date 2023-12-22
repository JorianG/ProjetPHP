<?php

namespace service;

use class\Personne;
use repositoring\PersonneDAO;

class PersonneService
{
    private PersonneDAO $personneDAO;
    private Personne $personne;

    public function __construct(Personne $personne)
    {
        $this->personneDAO = new PersonneDAO();
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