<?php

namespace class;
include_once "Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
use DateTime;

class Patient extends Personne
{
    private int $idPersonne;
    private int $numeroDeSecu;
    private String $adresse;
    private $dateDeNaisance;
    private string $lieuDeNaissance;

    private ?Medecin $medecinRefferent = null;


    public function __construct(int $numeroDeSecu,string $nom, string $prenom, Civilite $civilite, String $adresse,
                                DateTime $dateDeNaisance, string $lieuDeNaissance, Medecin $medecinRefferent=null)
    {
        parent::__construct($nom, $prenom, $civilite);
        $this->numeroDeSecu = $numeroDeSecu;
        $this->adresse = $adresse;
        $this->dateDeNaisance = $dateDeNaisance;
        $this->lieuDeNaissance = $lieuDeNaissance;
        if ($medecinRefferent != null) {
            $this->medecinRefferent = $medecinRefferent;
        }

        
    }


    public static function newFromRow(mixed $rows): Patient {
        $p = new Patient($rows['Num_secu'],$rows['Nom'], $rows['Prenom'], Civilite::fromString($rows['Civilite']),$rows['Adresse'],
        DateTime::createFromFormat('Y-m-d',$rows['DateNaissance']),$rows['LieuDeNaissance']);
        $p->setId($rows['Id_Personne']);
        return $p;
    }

    public function setIdPersonne(int $id): void
    {
        $this->idPersonne = $id;
    }

    public function getIdPersonne(): int
    {
        return $this->idPersonne;
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
    public function getAdresse(): String
    {
        return $this->adresse;
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
        $this->adresse = $addresse;
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