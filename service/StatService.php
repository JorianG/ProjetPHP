<?php

namespace service;

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";

use class\Civilite;
use class\Patient;
use DateTime;
class StatService {

    private PatientService $patientServ;

    private array $tabPatient = [];

    function __construct()
    {
        $this->patientServ = new PatientService();
        $result = $this->patientServ->getAll();
        foreach($result as $row){
            $this->tabPatient[] = (Patient::newFromRow($row));
        }
    }

    function getNbPatient() {
        return count($this->tabPatient);
    }

    function getNbPatientBySexe(Civilite $sexe) {
        $nb = 0;
        foreach ($this->tabPatient as $patient) {
            if ($patient->getCivilite() == $sexe) {
                $nb++;
            }
        }
        return $nb;
    }
    

    
    function getNbPatientBetweenAge(int $ageDebut, int $ageFin) {
        $nb = 0;
        
        foreach ($this->tabPatient as $patient) {
            
            $date = $patient->getDateDeNaisance();
            if ($date instanceof DateTime) {
                $age = $date->diff(new DateTime())->y;
                if ($age >= $ageDebut && $age <= $ageFin) {
                    $nb++;
                }
            }
        }
        return $nb;
    }

    function getNbPatientBySexeBetweenAge(Civilite $sexe, int $ageDebut, int $ageFin) {
        $nb = 0;
        foreach ($this->tabPatient as $patient) {
            $date = $patient->getDateDeNaisance();
            if ($date instanceof DateTime) {
                $age = $date->diff(new DateTime())->y;
                if ($age >= $ageDebut && $age <= $ageFin && $patient->getCivilite() == $sexe) {
                    $nb++;
                }
            }
        }
        return $nb;
    }

    

        
    
    

    
}


