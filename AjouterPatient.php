<?php

require("PDO.php");
include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";    
include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";   
include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";  

if (isset($_POST['submit'])) {

    function addPatient(){
        // Retrieve the form data
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $numSecu = $_POST['numSecu'];
        $dateN = DateTime::createFromFormat('Y-m-d', $_POST['dateN']);
        $lieuN = $_POST['lieuN'];
        $civ = $_POST['civ'];
        
        $patientToAdd = new class\Patient($numSecu,$nom, $prenom, class\Civilite::fromString($civ),$adresse, $dateN, $lieuN);
        $patientService = new service\PatientService();
        $patientService->insert($patientToAdd);
        
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        addPatient();


    header('Location: http://localhost/ProjetPHP/patients.php');
        
  
}
}
?>


