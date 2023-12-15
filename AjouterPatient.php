<!DOCTYPE html>

<html>
<?php
    include 'header.php';
    if (function_exists('customPageHeader')){
      customPageHeader();
    }?>
                <div class="container mt-5">
                 <h1 >Ajouter une Patient</h1>

<?php
if (isset($_POST['submit'])) {
        
    require("PDO.php");

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
        $query = "INSERT INTO `personne`(`Nom`, `Prenom`, `Civilite`) VALUES ($nom, $prenom, $civ)";
        try {
            $conn->query($query);
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
        }

        //Insert patient
        $query = "INSERT INTO `patient`(`Id_Personne`, `Num_secu`, `Adresse`, `DateNaissance`, `LieuDeNaissance`, `Id_Personne_Id_medeciRef`) VALUES ((SELECT Id_Personne FROM personne WHERE Nom = $nom AND Prenom = $prenom),$numSecu, $adresse, $dateN, $lieuN, null)";
        try {
            $conn->query($query);
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
        }
        // Close the connection
        
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo"<script>console.log('Patient ajouté');</script>";
        addPatient();
    }

    header('Location: http://localhost/ProjetPHP/patients.php');
}
?>

                <form class=""method="post" action="" >

                        <label class="floatingInput"for="civ">Civilité:</label>
                        <select class="form-control" name="civ" >
                            <option value="M">M</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                        </select>

                        <label class="floatingInput"for="prenom">Prénom:</label>
                        <input class="form-control" type="text" name="prenom"  id="floatingInput" required>

                        <label for="nom">Nom:</label>
                        <input class="form-control" type="text" name="nom"  required>

                        <label for="adresse">Adresse:</label>
                        <input class="form-control" type="text" name="adresse"  required>

                        <label for="numSecu">Num Secu:</label>
                        <input class="form-control" type="text" name="numSecu"  maxlength="13" required>

                        <label for="dateN">Date de Naissance:</label>
                        <input class="form-control" type="Date" name="dateN" required>

                        <label for="lieuN">Lieu de Naissance:</label>
                        <input class="form-control" type="text" name="lieuN"  required>
                        
                        <input class=" mt-2 btn btn-outline-primary btn-lg" type="submit" name="submit" value="Submit">
                    </form>
                    </div>
                <br/>

               
                </body>

                
                </html>
        
