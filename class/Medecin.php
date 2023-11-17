<?php

namespace class;

class Medecin extends Personne
{
    private int $id;

    public function __construct(string $nom, string $prenom, Civilite $civilite)
    {
        parent::__construct($nom, $prenom, $civilite);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}