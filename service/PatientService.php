<?php

namespace service;

use class\Patient;
use class\Personne;
use repositoring\PatientDAO;

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/repositoring/PatientDAO.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";


class PatientService
{
 

    private PatientDAO $PatientDAO;
    private Patient $patient;
    private Personne $personne;
    private PersonneService $personneService;


    public function __construct()
    {
        
        $this->PatientDAO = PatientDAO::getInstance();
        
    }

    public function insert(Patient $patient)
    {
        $this->patient = $patient;
        $this->personne = new Personne($this->patient->getNom(), $this->patient->getPrenom(), $this->patient->getCivilite());
        $this->personneService = new PersonneService();   
        $this->personneService->insert($this->personne);
        $this->PatientDAO->insert($this->patient);
    }

    public function update(Patient $patient)
    {
        $this->patient = $patient;
        $this->personne = new Personne($this->patient->getNom(), $this->patient->getPrenom(), $this->patient->getCivilite());
        $this->personneService = new PersonneService();
        $this->personneService->update($this->personne);
        $this->PatientDAO->update($this->patient);
    }

    public function delete(int $id_patient)
    {
        $this->personneService = new PersonneService($this->personne);
        $this->personneService->delete($id_patient);
        $this->PatientDAO->delete($id_patient);
    }

    public function selectById(int $id): Patient
    {
        return Patient::newFromRow($this->PatientDAO->selectById($id));
    }

    public function selectAll(): array
    {
        return Patient::newFromArray($this->PatientDAO->selectAll());
    }
}