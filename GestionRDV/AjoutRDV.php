<?php
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/RDV.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/RDVService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";

if (isset($_POST['submit'])) {

    function addRDV(){
        // Retrieve the form data
        $med = $_POST['med'];
        $pat = $_POST['pat'];
        $heure = $_POST['heure'];
        $date = $_POST['date'];
        $duree = $_POST['duree'];

        $medecinService = new \service\MedecinService();
        $medecin = $medecinService->getById($med);
        $medecin->setIdPersonne($med);

        $patientService = new \service\PatientService();
        $patient = $patientService->getById($pat);
        $patient->setIdPersonne($pat);

        try {
            $dateheure = new DateTime($date . ' ' . $heure);
            $dateheure->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            echo 'failed to create DateTime : ',  $e->getMessage(), "\n";
        }

        // Create a new patient and personne object
        $rdvToAdd = new class\RDV($patient, $medecin, $dateheure, $duree);
        //echo $rdvToAdd->getMedecin()->getIdPersonne();
        $rdvService = new service\RDVService();
        $rdvService->insert($rdvToAdd);

        header('Location: http://localhost/ProjetPHP/ListeRDV.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        addRDV();
    }
}