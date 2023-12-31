<?php

 
//include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";  
use service\PatientService;
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";

    function suprPatient(){
        $id_patient = $_POST['id_patient'];
        
        $patientService = new service\PatientService();
        $patientService->delete($id_patient);
        
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        suprPatient();

    }
   
        
  

header('Location: http://localhost/ProjetPHP/patients.php');
?>


