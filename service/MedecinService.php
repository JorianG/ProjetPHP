<?php

namespace service;
use class\Medecin;
use service\PersonneService;
use repositoring\MedecinDAO;
use class\Personne;

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Medecin.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/repositoring/MedecinDAO.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";
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

    public function insert(Medecin $medecin): void
    {
        $this->medecin = $medecin;
        $this->personne = new Personne($this->medecin->getNom(), $this->medecin->getPrenom(), $this->medecin->getCivilite());
        $this->personneService->insert($this->personne);
        $this->personne->setIdSql();
        $this->medecin->setIdPersonne($this->personne->getIdPersonne());
        $this->medecinDAO->insert($this->medecin);
    }

    public function update(Medecin $medecin): void
    {
        $this->medecin = $medecin;
        $this->personne = new Personne($this->medecin->getNom(), $this->medecin->getPrenom(), $this->medecin->getCivilite());
        $this->personneService->update($this->personne);
        $this->medecinDAO->update($this->medecin);
    }

    public function delete(int $id_medecin): void
    {
        $this->medecinDAO->delete($id_medecin);
        $this->personneService->delete($id_medecin);
    }

    public function getAll(): false|array
    {
        return $this->medecinDAO->getAll();

    }

    public function getById(int $id): Medecin
    {
        return Medecin::newFromRow($this->medecinDAO->getById($id));
    }

    public function getBySpecialite(string $specialite): false|array
    {
        return $this->medecinDAO->getBySpecialite($specialite);
    }

    public function isSet(int $id): bool
    {
        return $this->medecinDAO->isSet($id);
    }

    public function getPatients(int $id_medecin): false|array
    {
        return $this->medecinDAO->getPatients($id_medecin);
    }
}
?>

