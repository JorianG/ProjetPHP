<?php

namespace service;

use class\Patient;
use class\Personne;
use repositoring\PatientDAO;

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/¨Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/repositoring/PatientDAO.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";


class PersonneService
{
 
    private PersonneDAO $PersonneDAO;
    private Patient $patient;
    private Personne $personne;
    private PersonneService $personneService;


    public function __construct(Patient $patient)
    {
        $this->Personne = new Personne($patient->getNom(), $patient->getPrenom(), $patient->getCivilite().getName());
        $this->PatientDAO = new PatientDAO();
        $this->patient = $patient;
    }

    public function insert()
    {
        $this->PatientDAO->insert($this->patient);
    }

    public function update()
    {

        $this->PatientDAO->update($this->patient);
    }

    public function delete()
    {
        $this->PatientDAO->delete($this->patient->getIdPersonne());
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