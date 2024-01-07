<?php

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";  
use class\Patient;
    function modPatient(){
        // Retrieve the form data
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $numSecu = $_POST['numSecu'];
        $dateN = DateTime::createFromFormat('Y-m-d', $_POST['dateN']);
        $lieuN = $_POST['lieuN'];
        $civ = $_POST['civ'];
        $idPatient = intval($_POST['id_patient']);


        // Create a new patient and personne object
        $patientToAdd = new Patient($numSecu,$nom, $prenom, class\Civilite::fromString($civ),$adresse, $dateN, $lieuN);
        $patientToAdd->setIdPersonne($idPatient);
        $patientService = new service\PatientService();
        $patientService->update($patientToAdd);
        header('Location: http://localhost/ProjetPHP/ProfilPatient.php?id_patient='.$idPatient.'');
        

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        modPatient();
    }else
    {
        header('Location: http://localhost/ProjetPHP/ListePatients.php');
    }

?>