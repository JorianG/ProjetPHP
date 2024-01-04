<?php

namespace service;
use class\Medecin;
use service\PersonneService;
use repositoring\MedecinDAO;
use class\Personne;


class MedecinService
{
    private MedecinDAO $medecinDAO;
    private Medecin $medecin;
    private Personne $personne;
    private PersonneService $personneService;

    public function __construct()
    {
        $this->medecinDAO = MedecinDAO::getInstance();
        $this->personneService = new PersonneService();
    }

    public function insert(Medecin $medecin)
    {
        $this->medecin = $medecin;
        $this->personne = new Personne($this->medecin->getNom(), $this->medecin->getPrenom(), $this->medecin->getCivilite());
        $this->personneService->insert($this->personne);
        $this->medecin->setIdPersonne($this->personne->getIdPersonne());
        $this->medecinDAO->insert($this->medecin);
    }
}