<?php

namespace class;

use PDO;
use repositoring\PersonneDAO;

class Personne
{
    private int $idPersonne;
    private string $nom;
    private string $prenom;
    private Civilite $civilite;





    public function __construct(string $nom, string $prenom, Civilite $civilite) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->civilite = $civilite;
    }

    public static function newFromRow(mixed $rows): Personne {
        $p = new Personne($rows['Nom'], $rows['Prenom'], $rows['Civilite']);
        $p->setId($rows['Id_Personne']);
        return $p;
    }

    public static function newFromArray(array $rows): array {
        $personnes = [];
        foreach ($rows as $row) {
            $personnes[] = Personne::newFromRow($row);
        }
        return $personnes;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return Civilite
     */
    public function getCivilite(): Civilite
    {
        return $this->civilite;
    }

    public function getIdPersonne(): int
    {
        return $this->idPersonne;
    }

    public function setIdSql()
    {
        $this->idPersonne = (new PersonneDAO())->getLastId();
    }

    public function setId(int $id)
    {
        $this->idPersonne = $id;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @param Civilite $civilite
     */
    public function setCivilite(Civilite $civilite): void
    {
        $this->civilite = $civilite;
    }
}