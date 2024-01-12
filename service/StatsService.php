<?php

namespace service;

include './/header.php';
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";

use class\Civilite;
use class\Patient;
use DateTime;
class StatService {

    private PatientService $patientServ;

    private array $tabPatient;

    function __construct()
    {
        $this->patientServ = new PatientService();
        $this->tabPatient = $this->patientServ->getAll();
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
            echo $patient->getNom();
            // $date = $patient->getDateDeNaisance();
            // $now = new DateTime();
            // $interval = $date->diff($now);
            // $age = $interval->format('%y');
            // if ($age >= $ageDebut && $age <= $ageFin) {
            //     $nb++;
            // }
        }
        return $nb;

        
    }
    

    
}


