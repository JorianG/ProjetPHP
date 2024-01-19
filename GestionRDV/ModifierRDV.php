<?php

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/RDV.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Medecin.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/RDVService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";


if (isset($_POST["submit"])) {
    function modRDV() : void
    {
        $heure = $_POST['heure'];
        $date = $_POST['date'];
        $duree = $_POST['duree'];
        $idpatient=intval($_POST['pat']);
        $idmedecin=intval($_POST['med']);

        try {
            $dateheure = new DateTime($date . ' ' . $heure);
            $dateheure->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            echo 'failed to create DateTime : ',  $e->getMessage(), "\n";
        }

        $patientService = new \service\PatientService();
        $patient = $patientService->getById($idpatient);
        $patient->setIdPersonne($idpatient);

        $medecinService = new \service\MedecinService();
        $medecin = $medecinService->getById($idmedecin);
        $medecin->setIdPersonne($idmedecin);

        $rdvService = new service\RDVService();
        $rdv = new \class\RDV($patient, $medecin, $dateheure, $duree);
        $rdv->setId(intval($_POST['id_rdv']));
        try {
            $rdvService->update($rdv);
        } catch (Exception $e) {
            $message="Le patient ou le medecin a déjà un rendez-vous le ". $rdv->getDateHeure()->format('Y-m-d H:i:s');
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            sleep(5);
            header('Location: http://localhost/ProjetPHP/ListeRDV.php');
        }
    }

    modRDV();
}
