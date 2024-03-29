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
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/RDV.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/RDVService.php";


        function customHeader(){
            
            $MedServ = new service\MedecinService();

            // global $personne;
            global $Med; 
            global $idMed;

            $idMed = intval($_GET['id_med']);

            //$personne = $personneServ->selectById($_POST['id_patient']);
            if($MedServ->isSet($idMed)){
                $Med = $MedServ->getById($idMed);
                $Med->setIdPersonne($idMed);
            }
            else{
                header('Location: ./404.php');
            }
           

            customPageHeader('Profil du Dr '.$Med->getNom());
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

                <?php
                    $RDVServ = new service\RDVService();
                    $listeRDV = $RDVServ->selectAllByMedecin($Med);
                    //var_dump($listeRDV);
                    foreach ($listeRDV as $RDV) {
                        
                        echo "<div class=' col-6 m-1 p-3 rounded' style='background-color: white;'>";
                            echo "<div class='row'>";
                                echo "<div class='col-2'>";
                                    echo "<img src='./assets/patient.png' alt='' class='rounded-circle img-thumbnail' style='height: 70px;'>";
                                echo "</div>";
                                echo "<div class='col-10'>";
                                    echo "<h5 class='mt-2'>".$RDV->getPatient()->getNom()." ".$RDV->getPatient()->getPrenom()."</h5>";
                                    echo "<p class='mt-2'>Date : ".$RDV->getDate()->format('Y-m-d')."</p>";
                                    echo "<p class='mt-2'>Heure : ".$RDV->getHeure()->format('H:i')."</p>";
                                    echo "<p class='mt-2'>Motif : ".$RDV->getMotif()."</p>";
                                    
                                    echo "<form action='./ProfilPatient.php' method='GET'>";
                                    echo "<input type='hidden' name='id_patient' value='" . $RDV->getPatient()->getIdPersonne() . "'>";
                                    echo "<button type='submit' class='btn btn-primary p-2' >Voir le profil</button>";
                                    echo "</form>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                ?>
                
            </div>

       
                <div class=" container fixed border border-primary rounded m-3 p-2 overflow-auto" style="height: 500px;">
                    <h4>Liste des Patients</h4>
                    <div class="row m-2" style="overflow-x: hidden; width : 95%;">
                        <?php
                            $patientServ = new service\PatientService();
                            $listePatient = $patientServ->getAll();
                            $listePatient = $patientServ->getByMedecin($Med);
                            //var_dump($listePatient);
                            foreach ($listePatient as $patient) {
                                
                                //TODO Responsive
                                echo "<div class=' col-12 col-sm-6 p-3 rounded' style='background-color: white;'>";
                                    echo "<div class='row'>";
                                        echo "<div class='col-2'>";
                                            echo "<img src='./assets/patient.png' alt='' class='rounded-circle img-thumbnail' style='height: 70px;'>";
                                        echo "</div>";
                                        echo "<div class='col-10'>";
                                            echo "<h5 class='mt-2'>".$patient->getNom()." ".$patient->getPrenom()."</h5>";
                                            echo "<p class='mt-2'>Né le ".$patient->getDateDeNaisance()->format('Y-m-d')."</p>";
                                            echo "<p class='mt-2'>Adresse : ".$patient->getAdresse()."</p>";
                                            echo "<p class='mt-2'>Numéro de sécurité sociale : ".$patient->getNumeroDeSecu()."</p>";
                                            
                                            echo "<form action='./ProfilPatient.php' method='GET'>";
                                            echo "<input type='hidden' name='id_patient' value='" . $patient->getIdPersonne() . "'>";
                                            echo "<button type='submit' class='btn btn-primary p-2' >Voir le profil</button>";
                                            echo "</form>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        ?>
                        
                    
                    </div>
                </div>

        </div>
    </div>
</html>