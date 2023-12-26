<?php

use class\Medecin;
use class\Patient;

require 'ConnexionDB.php';
    function creerTables() {
        $db = connexion();

    
        $sql = "CREATE TABLE Personne (
            Id_Personne INT AUTO_INCREMENT not null,
            Nom VARCHAR(50) NOT NULL,
            Prenom VARCHAR(50)NOT NULL,
            Civilite VARCHAR(3) NOT NULL,
            PRIMARY KEY(Id_Personne)
        );";
        $db->exec($sql);

        echo "<script>console.log('Table Personne crée');</script>";

        $sql = "CREATE TABLE Medecin (
            Id_Personne INT NOT NULL,
            PRIMARY KEY(Id_Personne),
            FOREIGN KEY(Id_Personne) REFERENCES Personne(Id_Personne)
        );";
        $db->exec($sql);

        echo "<script>console.log('Table Medecin crée');</script>";

        $sql = "CREATE TABLE Patient (
            Id_Personne INT NOT NULL,
            Num_secu VARCHAR(13) NOT NULL,
            Adresse VARCHAR(150) NOT NULL,
            DateNaissance DATE NOT NULL,
            LieuDeNaissance VARCHAR(150) NOT NULL,
            Id_Personne_Id_medeciRef INT NOT NULL,
            PRIMARY KEY(Id_Personne),
            FOREIGN KEY(Id_Personne) REFERENCES Personne(Id_Personne),
            FOREIGN KEY(Id_Personne_Id_medeciRef) REFERENCES Medecin(Id_Personne)
        );";
        $db->exec($sql);

        echo "<script>console.log('Table Patient crée');</script>";

        $sql = "CREATE TABLE RDV (
            Id_Personne_id_medecin INT NOT NULL,
            Id_Personne_Id_Patient INT NOT NULL,
            Id_RDV INT AUTO_INCREMENT NOT NULL,
            DateHeure DATETIME NOT NULL,
            DureeEnM INT NOT NULL,
            PRIMARY KEY(Id_RDV),
            FOREIGN KEY(Id_Personne_id_medecin) REFERENCES Medecin(Id_Personne),
            FOREIGN KEY(Id_Personne_Id_Patient) REFERENCES Patient(Id_Personne)
        );";
        $db->exec($sql);

        echo "<script>console.log('Table RDV crée');</script>";

       
        
        echo "<script>console.log('Tables crées');</script>";
    }
    creerTables();

    function insererPatient(Patient $patient): void
    {
        $db = connexion();

        $sql = "INSERT INTO Personne VALUES ('".$patient->getNom()."', '".$patient->getPrenom()."', '".$patient->getCivilite()->getName()."');";
        $db.exec($sql);
        $sql = "select max(id_personne) from Personne";
        $id= $db.exec($sql);
        $sql = "INSERT INTO Patient VALUES (".$id.", '".$patient->getNumeroDeSecu()."', '".$patient->getAdresse()."', ".$patient->getDateDeNaisance()->format("d/m/Y H:i").", '".$patient->getLieuDeNaissance()."';)";
        $db.exec($sql);
    }

    function insererMedecin(Medecin $medecin): void
    {
        $db = connexion();

        $sql = "INSERT INTO Personne VALUES ('".$medecin->getNom()."', '".$medecin->getPrenom()."', '".$medecin->getCivilite()->getName()."');";
        $db.exec($sql);
        $sql = "select max(id_personne) from Personne";
        $id= $db.exec($sql);
        $sql = "INSERT INTO Medecin VALUES (".$id.";)";
        $db.exec($sql);
    }

    function insererRDV(RDV $rdv): void
    {
        $db = connexion();

        $sql = "INSERT INTO RDV VALUES (".($rdv->getMedecin()->getId()).", ".$rdv->getPatient()->getId().", '".$rdv->getDateHeure()."', ".$rdv->getDureeEnMinute().")";
    }

?>





