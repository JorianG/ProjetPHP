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
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Medecin.php";


        function customHeader(){
            
            $MedServ = new service\MedecinService();

            // global $personne;
            global $Med; 
            global $idMed;

            $idMed = intval($_GET['id_med']);

            //$personne = $personneServ->selectById($_POST['id_patient']);
            if($MedServ->isSet($idMed)){
                $Med = $MedServ->getById($idMed);
            }
            else{
                header('Location: ./404.php');
            }
           

            customPageHeader('Profil du Dr '.$Med->getNom().';');
        }

        //if directly accessed, redirect to ListePatients.php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {   
            customHeader();
        }
        else{
            header('Location: ./ListeMedecin.php');
        }

    ?>
    <div class=" container " style="margin-top: 18px;">
        <div class="row">
            <div class="col-2">
                <img src="./assets/docteur.png" alt="" class="rounded-circle img-thumbnail" style="height: 200px;">
            </div>
            <div class="col-4 h5 border border-primary rounded m-3 p-2">
                <form class="" method="POST" action="./GestionMedecin/ModifierMedecin.php" >
                
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {

                        //civilité
;
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='nom'> Civilité :</label>
                        <div class='col-sm-9'>
                            <select class='form-control form-control-sm' name='civ' id=''>";
                                
                                $civ = $Med->getCivilite()->getName();
                                if ($civ == "M") {
                                    echo "<option value='MR' selected>Mr</option>";
                                    echo "<option value='MLE'>Mlle</option>";
                                    echo "<option value='MME'>Mme</option>";
                                }else if ($civ == "MME") {
                                    echo "<option value='MR'>Mr</option>";
                                    echo "<option value='MLE'>Mlle</option>";
                                    echo "<option value='MME' selected>Mme</option>";
                                }else{
                                    echo "<option value='MR'>Mr</option>";
                                    echo "<option value='MLE' selected>Mlle</option>";
                                    echo "<option value='MME'>Mme</option>";
                                }

                            echo "</select>
                        </div>
                        </div>";

                        
                        //prenom
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='prenom'> Prénom :</label>
                        <div class='col-sm-9'>
                            <input class='form-control form-control-sm' type='text' name='prenom' value=".$Med->getPrenom().">
                        </div>
                        </div>";
                        
                        
                        //nom
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='nom'> Nom :</label>
                        <div class='col-sm-9'>
                            <input class='form-control form-control-sm' type='text' name='nom' value=".$Med->getNom().">
                        </div>
                        </div>";
                    
                        
                        //Specialité
                        echo "<div class='form-group row mb-2'>
                        <label class='col-sm-3 col-form-label-sm' for='nom'> Spécialité :</label>
                        <div class='col-sm-9'>
                            <input class='form-control form-control-sm' type='text' name='spe' value=".$Med->getSpecialite().">
                        </div>
                        </div>";

                        //hidden id
                        echo "<input type='hidden' name='idMed' value='" . $idMed . "'>";
 
                        echo "<input class=' float-right btn btn-outline-primary ' type='submit' value='Modifier'>";


                        //Form to see medecin
                        // if ($Med->getMedecinRefferent() != null) {
                        //     echo "<form action='./Medecin.php' method='POST'>";
                        //     echo "<input type='hidden' name='id_medecin' value='" . $Med->getMedecinRefferent()->getId() . "'>";
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