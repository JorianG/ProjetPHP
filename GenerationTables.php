<?php
    include 'ConnexionDB.php';
    function creerTables() {
        $db = connexion();

    
        $sql = "CREATE TABLE `Personne` (
            `Id_Personne` AUTO_INCREMENT NOT NULL,
            `Nom` VARCHAR(50) NOT NULL,
            `Prenom` VARCHAR(50)NOT NULL,
            `Civilite` VARCHAR(3) NOT NULL,
            PRIMARY KEY(Id_Personne)
        );";
        $db->exec($sql);

        $sql = "CREATE TABLE `Patient` (
            `Id_Personne` INT NOT NULL,
            `Num_secu` VARCHAR(13) NOT NULL,
            `Adresse` VARCHAR(150) NOT NULL,
            `DateNaissance` DATE NOT NULL,
            `LieuDeNaissance` VARCHAR(150) NOT NULL,
            `Id_Personne_Id_medeciRef` INT NOT NULL,
            PRIMARY KEY(`Id_Personne`),
            FOREIGN KEY(`Id_Personne`) REFERENCES `Personne`(`Id_Personne`),
            FOREIGN KEY(`Id_Personne_Id_medeciRef`) REFERENCES `Medecin`(`Id_Personne`)
        );";
        $db->exec($sql);

        $sql = "CREATE TABLE `RDV` (
            `Id_Personne_id_medecin` INT NOT NULL,
            `Id_Personne_Id_Patient` INT NOT NULL,
            `Id_RDV` AUTO_INCREMENT NOT NULL,
            `DateHeure` DATETIME NOT NULL,
            `DureeEnM` INT NOT NULL,
            PRIMARY KEY(`Id_Personne_id_medecin`, `Id_Personne_Id_Patient`, `Id_RDV`),
            FOREIGN KEY(`Id_Personne_id_medecin`) REFERENCES `Medecin`(`Id_Personne`),
            FOREIGN KEY(`Id_Personne_Id_Patient`) REFERENCES `Patient`(`Id_Personne`)
        );";
        $db->exec($sql);

        $sql = "CREATE TABLE `Medecin` (
            `Id_Personne` INT NOT NULL,
            `Specialite` VARCHAR(50) NOT NULL,
            PRIMARY KEY(`Id_Personne`),
            FOREIGN KEY(`Id_Personne`) REFERENCES `Personne`(`Id_Personne`)
        );";
        $db->exec($sql);
        
        echo "<script>console.log('Tables crées');</script>";
    }
?>




?>
