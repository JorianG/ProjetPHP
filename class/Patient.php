<?php

namespace class;

use DateTime;

class Patient extends Personne
{
    private int $numeroDeSecu;
    private String $addresse;
    private DateTime $dateDeNaisance;
    private string $lieuDeNaissance;

    private Medecin $medecinRefferent;


    public function __construct(int $numeroDeSecu,string $nom, string $prenom, Civilite $civilite, String $addresse,
                                DateTime $dateDeNaisance, string $lieuDeNaissance, Medecin $medecinRefferent=null)
    {
        parent::__construct($nom, $prenom, $civilite);
        $this->numeroDeSecu = $numeroDeSecu;
        $this->addresse = $addresse;
        $this->dateDeNaisance = $dateDeNaisance;
        $this->lieuDeNaissance = $lieuDeNaissance;
        if ($this->medecinRefferent == null) {
            $this->medecinRefferent = $medecinRefferent;
        }
    }

    /**
     * @return int
     */
    public function getNumeroDeSecu(): int
    {
        return $this->numeroDeSecu;
    }

    /**
     * @return String
     */
    public function getAddresse(): String
    {
        return $this->addresse;
    }

    /**
     * @return DateTime
     */
    public function getDateDeNaisance(): DateTime
    {
        return $this->dateDeNaisance;
    }

    /**
     * @return string
     */
    public function getLieuDeNaissance(): string
    {
        return $this->lieuDeNaissance;
    }

    /**
     * @return Medecin
     */
    public function getMedecinRefferent(): Medecin
    {
        return $this->medecinRefferent;
    }

    /**
     * @param int $numeroDeSecu
     */
    public function setNumeroDeSecu(int $numeroDeSecu): void
    {
        $this->numeroDeSecu = $numeroDeSecu;
    }

    /**
     * @param String $addresse
     */
    public function setAddresse(String $addresse): void
    {
        $this->addresse = $addresse;
    }

    /**
     * @param DateTime $dateDeNaisance
     */
    public function setDateDeNaisance(DateTime $dateDeNaisance): void
    {
        $this->dateDeNaisance = $dateDeNaisance;
    }

    /**
     * @param string $lieuDeNaissance
     */
    public function setLieuDeNaissance(string $lieuDeNaissance): void
    {
        $this->lieuDeNaissance = $lieuDeNaissance;
    }

    /**
     * @param Medecin $medecinRefferent
     */
    public function setMedecinRefferent(Medecin $medecinRefferent): void
    {
        $this->medecinRefferent = $medecinRefferent;
    }
}