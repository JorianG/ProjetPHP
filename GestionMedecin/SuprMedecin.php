<?php

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/domaine/PersonneService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";


    function suprMedecin(){
        $id_medecin = $_POST['id_med'];

        //reset all the patients that have this medecin as their medecin traitant
        $patientService = new service\PatientService();
        $patientService->resetMedecinTraitant($id_medecin);
        
        $medecinService = new service\MedecinService();
        $medecinService->delete($id_medecin);

        $persService = new service\PersonneService();
        $persService->delete($id_medecin);
        
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        suprMedecin();

    }

    header('Location: http://localhost/ProjetPHP/ListeMedecin.php');
?>



