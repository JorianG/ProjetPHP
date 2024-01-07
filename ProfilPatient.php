<!DOCTYPE html>
<html>

    <?php
        include './/header.php';
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Patient.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PersonneService.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Personne.php";

        function customHeader(){
            
            $patientServ = new service\PatientService();

            // global $personne;
            global $patient; 
            global $idPatient;

            $idPatient = $_GET['id_patient'];
            $idPatient = intval($idPatient);
            //$personne = $personneServ->selectById($_POST['id_patient']);
            $patient = $patientServ->getById($idPatient);      

            customPageHeader('Profil de '.$patient->getNom().' '.$patient->getPrenom());
        }

        //if directly accessed, redirect to ListePatients.php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {   
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
                <form class="" method="POST" action="./GestionPatient/ModifierPatient.php" >
                
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {

                        //civilité
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='nom'> Civilité :</label>
                        <div class='col-sm-9'>
                            <select class='form-control form-control-sm' name='civ' id=''>
                                <option value='MR'>Mr</option>
                                <option value='MME'>Mme</option>
                                <option value='MLE'>Mlle</option>
                            </select>
                        </div>
                        </div>";

                        
                        //prenom
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='prenom'> Prénom :</label>
                        <div class='col-sm-9'>
                            <input class='form-control form-control-sm' type='text' name='prenom' value=".$patient->getPrenom().">
                        </div>
                        </div>";
                        
                        
                        //nom
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='nom'> Nom :</label>
                        <div class='col-sm-9'>
                            <input class='form-control form-control-sm' type='text' name='nom' value=".$patient->getNom().">
                        </div>
                        </div>";
                        

                        //adresse
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='adresse'> Adresse :</label>
                        <div class='col-sm-9'>
                            <input class='form-control form-control-sm' type='text' name='adresse' value='".$patient->getAdresse()."'>
                        </div>
                        </div>";

                        //numSecu
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-6 col-form-label-sm' for='numSecu'> Numéro de sécurité sociale :</label>
                        <div class='col-sm-6'>
                            <input class='form-control form-control-sm' type='text' name='numSecu' value=".$patient->getNumeroDeSecu()." maxlength='10' pattern='[0-9]+'>
                        </div>
                        </div>";

                        

                        // Calculate age
                        $birthDate = $patient->getDateDeNaisance();
                        $today = new DateTime();
                        $age = $today->diff($birthDate)->y;

                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='age'> Age :".$age."</label>
                        </div>";

                        
                       
                        //dateN
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-4 col-form-label-sm' for='dateN'> Date de naissance :</label>
                        <div class='col-sm-8'>
                            <input class='form-control form-control-sm' type='date' name='dateN' value=".$patient->getDateDeNaisance()->format('Y-m-d').">
                        </div>
                        </div>";

                        

                        // lieu de naissance
                        echo "<div class='form-group row mb-2'>
                            <label class='col-sm-4 col-form-label-sm' for='lieuN'> Lieu de naissance :</label>
                            <div class='col-sm-8'>
                                <input class='form-control form-control-sm' type='text' name='lieuN' value=".$patient->getLieuDeNaissance().">
                            </div>
                        </div>";
                        
                        //echo $patient->getMedecinRefferent()->getIdPersonne();
                        //medecin
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-4 col-form-label-sm' for='med'> Médecin référent :</label>
                        <div class='col-sm-8'>
                            <select class='form-control form-control-sm' name='med' id='' value='".$patient->getMedecinRefferent()->getIdPersonne()."'>";
                            $medecinReferentId = $patient->getMedecinRefferent()->getIdPersonne();
                            $service = new service\MedecinService();
                            $result = $service->getAll();
                            foreach ($result as $row) {
                                $selected = $row['Id_Personne'] == $medecinReferentId ? 'selected' : '';
                                echo '<option value="'.$row['Id_Personne'].'" '.$selected.'> ['.$row['Specialite'].'] '.$row['Nom'].' '.$row['Prenom'].'</option>';
                            }
                            echo "</select>
                        </div>
                        </div>";

                        //hidden id
                        echo "<input type='hidden' name='id_patient' value='" . $idPatient . "'>";
 
                        echo "<input class=' float-right btn btn-outline-primary ' type='submit' value='Modifier'>";


                        //Form to see medecin
                        // if ($patient->getMedecinRefferent() != null) {
                        //     echo "<form action='./Medecin.php' method='POST'>";
                        //     echo "<input type='hidden' name='id_medecin' value='" . $patient->getMedecinRefferent()->getId() . "'>";
                        //     echo "<button type='submit'>Voir le médecin référent</button>";
                        //     echo "</form>";
                        // }
                        // Add more information to echo here
                            
                        //Form to edit patient
                        // echo "<form  class='p-2     ' action='./EditPatient.php' method='POST'>";
                        // echo "<input type='hidden' name='id_patient' value='" . $idPatient . "'>";
                        // echo "<button type='submit' class='btn btn-primary p-2' >Modifier</button>";
                        // echo "</form><br>";
                    }
                ?>
                </form>
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