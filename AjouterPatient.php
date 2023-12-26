
<?php
if (isset($_POST['submit'])) {
    // Remove the unnecessary "use class\Personne;" statement
    
    require("PDO.php");
    include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";    
    include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
    include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
    include $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";     

    function addPatient(){
        $conn = getInstance();

        // Retrieve the form data
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $numSecu = $_POST['numSecu'];
        $dateN = $_POST['dateN'];
        $lieuN = $_POST['lieuN'];
        $civ = $_POST['civ'];

        // Insert the patient into the database
        //Insert personne


        $personneToAdd = new class\Personne($nom, $prenom, class\Civilite::fromString($civ) );
        $personneService = new service\PersonneService($personneToAdd);
        $personneService->insert();
        

        // $query = "INSERT INTO `personne`(`Nom`, `Prenom`, `Civilite`) VALUES (?, ?, ?)";
        // try {
        //     $stmt = $conn->prepare($query);
        //     $stmt->execute([$nom, $prenom, $civ]);
        //     echo"<script>console.log('Patient ajouté');</script>";
        // } catch (PDOException $e) {
        //     echo "Erreur de requête : " . $e->getMessage();
        // }

        //Insert patient*



        $query = "INSERT INTO `patient`(`Id_Personne`, `Num_secu`, `Adresse`, `DateNaissance`, `LieuDeNaissance`, `Id_Personne_Id_medeciRef`) VALUES ((SELECT Id_Personne FROM personne WHERE Nom = ? AND Prenom = ?), ?, ?, ?, ?, 1)";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute([$nom, $prenom, $numSecu, $adresse, $dateN, $lieuN]);
            echo"<script>console.log('Patient ajouté');</script>";
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
        }
        // Close the connection
        
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        addPatient();


    header('Location: http://localhost/ProjetPHP/patients.php');
        
  
}
}
?>


