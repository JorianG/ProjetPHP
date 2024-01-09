<?php

namespace service;

use class\Medecin;
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

    private PersonneService $personneService;
    private MedecinService $medecinService;


    public function __construct()
    {
        
        $this->PatientDAO = PatientDAO::getInstance();
        $this->personneService = new PersonneService();
        $this->medecinService = new MedecinService();   
    }

    public function insert(Patient $patient): void
    {
        
        $personne = new Personne($patient->getNom(), $patient->getPrenom(), $patient->getCivilite());
        $this->personneService->insert($personne);
        $personne->setIdSql();
        $patient->setIdPersonne($personne->getIdPersonne());
        $this->PatientDAO->insert($patient);
    }

    public function update(Patient $patient): void
    {
        $personne = new Personne($patient->getNom(), $patient->getPrenom(), $patient->getCivilite());
        $personne->setId($patient->getIdPersonne());

        $this->personneService->update($personne);
        $this->PatientDAO->update($patient);
    }

    public function delete(int $id_patient): void
    {
        $this->PatientDAO->delete($id_patient);
        $this->personneService->delete($id_patient);
        
    }

    public function getById(int $id): Patient
    {   
        $patient = Patient::newFromRow($this->PatientDAO->selectById($id));
        $patient->setIdPersonne($id);

        if($this->PatientDAO->getMedecinRefferent($id)['Id_Personne_Id_medeciRef'] != null){
            $medRef = $this->medecinService->getById($this->PatientDAO->getMedecinRefferent($id)['Id_Personne_Id_medeciRef']);
            $medRef->setIdPersonne($this->PatientDAO->getMedecinRefferent($id)['Id_Personne_Id_medeciRef']);
        }else{
            $medRef = null;
        }
        
        $patient->setMedecinRefferent($medRef);
        return $patient;
        
    }

    public function getAll(): array
    {
        return $this->PatientDAO->selectAll();
    }

    public function resetMedecinTraitant(int $id_medecin)
    {
        $this->PatientDAO->resetMedecinTraitant($id_medecin);
    }

    public function isSet(int $id_personne): bool
    {
        return $this->PatientDAO->isSet($id_personne);
    }

    public function getByMedecin(Medecin $medecin): array
    {
        $patients = array();
        $patientsId = $this->PatientDAO->selectAllByMedecin($medecin->getIdPersonne());
        foreach ($patientsId as $patientId) {
            $patient = $this->getById($patientId['Id_Personne']);
            array_push($patients, $patient);
        }
        return $patients;
    }
}