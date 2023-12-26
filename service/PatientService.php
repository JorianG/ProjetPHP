<?php

namespace service;

use class\Patient;
use repositoring\PatientDAO;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/¨Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/repositoring/PatientDAO.php";

class PersonneService
{
    private PatientDAO $PatientDAO;
    private Patient $patient;

    public function __construct(Patient $patient,)
    {
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