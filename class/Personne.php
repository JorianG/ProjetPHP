<?php

namespace class;

class Personne
{
    private string $nom;
    private string $prenom;
    private Civilite $civilite;


    public function __construct(string $nom, string $prenom, Civilite $civilite) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->civilite = $civilite;
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