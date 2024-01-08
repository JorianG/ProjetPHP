<?php

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Medecin.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";

use class\Medecin;
    function modMedecin(): void
    {
        // Retrieve the form data
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $spe = $_POST['spe'];
        $civ = $_POST['civ'];
        $idMedecin = intval($_POST['idMed']);


        // Create a new patient and personne object
        $MedtoAdd = new Medecin($nom, $prenom, class\Civilite::fromString($civ), $spe);
        $MedtoAdd->setIdPersonne($idMedecin);
        $serMed = new service\MedecinService();
        $serMed->update($MedtoAdd);

        // Update the patient to the database
        header('Location: http://localhost/ProjetPHP/ProfilMedecin.php?id_med='.$idMedecin.'');
        

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        modMedecin();
    }else
    {
        header('Location: http://localhost/ProjetPHP/ListeMedecin.php');
    }

?>