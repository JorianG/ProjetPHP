<?php

namespace class;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";


class Medecin extends Personne
{
    private int $idPersonne;
    private string $specialite;

    public function __construct(string $nom, string $prenom, Civilite $civilite, string $specialite)
    {
        parent::__construct($nom, $prenom, $civilite);
        $this->specialite = $specialite;
    }

    public static function newFromRow(mixed $rows): Medecin {
        $m = new Medecin($rows['Nom'], $rows['Prenom'], Civilite::fromString($rows['Civilite']), $rows['Specialite']);
        $m->setId($rows['Id_Personne']);
        
        return $m;
    }

    

    /**
     * @return string
     */
    public function getSpecialite(): string
    {
        return $this->specialite;
    }

    public function setIdPersonne(int $id): void
    {
        $this->idPersonne = $id;
    }

    public function getIdPersonne(): int
    {
        return $this->idPersonne;
    }


}