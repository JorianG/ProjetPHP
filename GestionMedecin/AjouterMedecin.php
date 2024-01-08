<?php

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Medecin.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";


if (isset($_POST['submit'])) {

    function addMedecin(){
        // Retrieve the form data
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $civ = $_POST['civ'];
        $specialite = $_POST['spe'];
        

        // Create a new patient and personne object
        $medecinToAdd = new class\Medecin($nom, $prenom, class\Civilite::fromString($civ), $specialite);
        $medecinService = new service\MedecinService();
        $medecinService->insert($medecinToAdd);
        
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        addMedecin();
    }
header('Location: http://localhost/ProjetPHP/ListeMedecin.php');
}
?>   