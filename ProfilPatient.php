<!DOCTYPE html>
<html>

    <?php
        include './/header.php';
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";

        function customHeader(){
            
            $patientServ = new service\PatientService();

            // global $personne;
            global $patient; 
            global $idPatient;

            $idPatient = $_POST['id_patient'];
            //$personne = $personneServ->selectById($_POST['id_patient']);
            $patient = $patientServ->selectById($idPatient);      

            customPageHeader('Profil de '.$patient->getNom().' '.$patient->getPrenom());
        }

        //if directly accessed, redirect to ListePatients.php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {   
            customHeader();
        }
        else{
            header('Location: ./ListePatients.php');
        }

    ?>
    <div class=" container " style="margin-top: 18px;">
        <div class="row">
            <div class="col-2">
                <img src="./assets/patient.png" alt="" class="rounded-circle img-thumbnail" style="height: 200px;">
            </div>
            <div class="col-4 h5 border border-primary rounded m-3 p-2">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        echo "<b>Nom: </b>" . $patient->getNom() . "<br><br>";
                        echo "<b>Prénom: </b>" . $patient->getPrenom() . "<br><br>";
                        echo "<b>Civilité: </b>" . $patient->getCivilite()->getName() . "<br><br>";
                        echo "<b>N° de sécurité sociale: </b>" . $patient->getNumeroDeSecu() . "<br><br>";
                        echo "<b>Adresse: </b>" . $patient->getAdresse() . "<br><br>";
                        

                        // Calculate age
                        $birthDate = $patient->getDateDeNaisance();
                        $today = new DateTime();
                        $age = $today->diff($birthDate)->y;
                        echo "<b>Age: </b>" . $age . "<br><br>";

                        // Add more information to echo here
                        echo "<b>Date de naissance: </b>" . $patient->getDateDeNaisance()->format('d/m/Y') . "<br><br>";
                        echo "<b>Lieu de naissance: </b>" . $patient->getLieuDeNaissance() . "<br><br>";

                        //Form to see medecin
                        // if ($patient->getMedecinRefferent() != null) {
                        //     echo "<form action='./Medecin.php' method='POST'>";
                        //     echo "<input type='hidden' name='id_medecin' value='" . $patient->getMedecinRefferent()->getId() . "'>";
                        //     echo "<button type='submit'>Voir le médecin référent</button>";
                        //     echo "</form>";
                        // }
                        // Add more information to echo here

                        //Form to edit patient
                        echo "<form  class='p-2     ' action='./EditPatient.php' method='POST'>";
                        echo "<input type='hidden' name='id_patient' value='" . $idPatient . "'>";
                        echo "<button type='submit' class='btn btn-primary p-2' >Modifier</button>";
                        echo "</form><br>";
                    }
                ?>
            </div>
            <div class="col-5 border border-primary rounded m-3 p-2 overflow-auto" style="height: 500px;">
                <h4>Liste des Rendez-Vous</h4>

                <div class="m-1 rounded" style="background-color: white; height : 100px;"></div>
                <div class="m-1 rounded" style="background-color: white; height : 100px;"></div>
                    
                <!-- TODO : Add list of RDV here -->

                
            </div>
        </div>
    </div>
</html>