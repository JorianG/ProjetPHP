<?php

namespace service;

use class\Patient;
use class\Personne;
use repositoring\PatientDAO;

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/repositoring/PatientDAO.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";




class PatientService
{
 

    private PatientDAO $PatientDAO;
    private Patient $patient;
    private Personne $personne;
    private PersonneService $personneService;
    private MedecinService $medecinService;


    public function __construct()
    {
        
        $this->PatientDAO = PatientDAO::getInstance();
        $this->personneService = new PersonneService();
        $this->medecinService = new MedecinService();   
    }

    public function insert(Patient $patient)
    {
        $this->patient = $patient;
        $this->personne = new Personne($this->patient->getNom(), $this->patient->getPrenom(), $this->patient->getCivilite());
        
        $this->personneService->insert($this->personne);
        $this->personne->setIdSql();
        $this->patient->setIdPersonne($this->personne->getIdPersonne());
        $this->PatientDAO->insert($this->patient);
    }

    public function update(Patient $patient)
    {
        $this->patient = $patient;
        $this->personne = new Personne($this->patient->getNom(), $this->patient->getPrenom(), $this->patient->getCivilite());
        $this->personne->setId($this->patient->getIdPersonne());
        $this->personneService->update($this->personne);
        $this->PatientDAO->update($this->patient);
    }

    public function delete(int $id_patient)
    {
        $this->PatientDAO->delete($id_patient);
        $this->personneService->delete($id_patient);
        
    }

    public function getById(int $id): Patient
    {   
        $patient = Patient::newFromRow($this->PatientDAO->selectById($id));
        $patient->setIdPersonne($id);
        $medRef = $this->medecinService->getById($this->PatientDAO->getMedecinRefferent($id)['Id_Personne_Id_medeciRef']);
        $medRef->setIdPersonne($this->PatientDAO->getMedecinRefferent($id)['Id_Personne_Id_medeciRef']);
        $patient->setMedecinRefferent($medRef);
        return $patient;
        
    }

    public function getAll(): array
    {
        return $this->PatientDAO->selectAll();
    }
}