<?php

namespace class;

class Medecin extends Personne
{

    public function __construct(string $nom, string $prenom, Civilite $civilite)
    {
        parent::__construct($nom, $prenom, $civilite);
    }
}