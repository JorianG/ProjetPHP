<?php

 
//include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";  
use service\PatientService;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/domaine/PersonneService.php";

    function suprPatient(){
        $id_patient = $_POST['id_patient'];
        
        $patientService = new service\PatientService();
        $patientService->delete($id_patient);

        $persService = new service\PersonneService();
        $persService->delete($id_patient);

        
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        suprPatient();

    }
   
        
  

header('Location: http://localhost/ProjetPHP/ListePatients.php');
?>


