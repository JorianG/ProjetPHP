<?php
    include './/header.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/RDVService.php";

    function customHeader(){
        $service = new \service\RDVService();

        global $rdv;
        global $idRDV;
        global $patient;
        global $medecin;

        $idRDV = intval($_GET['id_rdv']);
        if ($service->isSet($idRDV)){
            $rdv = $service->getById($idRDV);
            $medecin = $rdv->getMedecin();
            $patient = $rdv->getPatient();
        }
        else{
            header('Location: ./404.php');
        }

        customPageHeader('RDV de '.$rdv->getPatient()->getNom().' '.$rdv->getPatient()->getPrenom().' avec le Dr.'.$rdv->getMedecin()->getNom());
    }

    //if directly accessed, redirect to ListeRDV.php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        customHeader();
    }
    else{
        header('Location: ./ListeRDV.php');
    }
?>
<div class=" container mt-3" style="margin-top=18px">
    <div class="row mx-auto">
        <div class="col-12 h5 border border-primary rounded p-2">
            <form method="post" action="./GestionRDV/ModifierRDV.php">
                <div class="row mb-2">

                </div>
                <div class="row mb-5">
                    <div class="col-sm-5 form-group">
                        <label class="col-sm-12 col-form-label" for="med"> Patient :</label>
                        <?php
                        $service = new \service\PatientService();
                        $result = $service->getAll();
                        $idPatient = $GLOBALS["rdv"]->getPatient()->getIdPersonne();
                        echo "<select class='form-control form-control-sm' name='pat' id='' required >";
                        foreach ($result as $row) {
                            $selected = $row['Id_Personne'] == $idPatient ? "selected" : '';
                            echo "<option value='".$row['Id_Personne']."' ".$selected."> ".$row['Civilite']." ".$row['Nom']." ".$row['Prenom']."</option>";
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class="col-sm-5 form-group">
                        <label class="col-sm-12 col-form-label" for="med"> Medecin :</label>
                        <?php
                        $service = new \service\MedecinService();
                        $result = $service->getAll();
                        $idMedecin = $GLOBALS["rdv"]->getMedecin()->getIdPersonne();
                        echo "<select class='form-control form-control-sm' name='med' id='' required >";
                        foreach ($result as $row) {
                            $selected = $row['Id_Personne'] == $idMedecin ? "selected" : '';
                            echo "<option value='".$row['Id_Personne']."' ".$selected."> [".$row['Specialite']."] ".$row['Nom']." ".$row['Prenom']."</option>";
                        }
                        echo "</select>"
                        ?>
                    </div>
                </div>
                <div class="row mb-2 "><label class="col-sm-12" for="med"> Rendez-vous :</label></div>
                <div class="row mb-2">
                    <div class="col-sm-4 form-group">
                        <label class="col-sm-1 col-form-label">Le : </label>
                        <?php
                            $date = $GLOBALS["rdv"]->getDateHeure();
                            echo "<input class='form-control-sm col-sm-5' type='date' name='date' id='' value='".$date->format('Y-m-d')."' required>";
                        ?>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="col-sm-1 col-form-label">À : </label>
                        <?php
                            echo "<input class='form-control-sm col-sm-5' type='time' min='8:00' max='18:00' name='heure' id='' value='".$date->format('H:i')."' required>";
                        ?>
                    </div>
                    <div class="col-sm-4 form-group col-form-label">
                        <label class="col-sm-3">Pendant : </label>
                        <?php
                            echo "<input class='form-control-sm col-sm-5' type='number' name='duree' min='0' max='120' step='5' pattern='[0-9]+' id='' value='".$rdv->getDureeEnMinute()."' required>"
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-2">
                        <input type="hidden" name="id_rdv" value="<?php echo $idRDV?>"> <!-- TODO : POPUP MEDECIN DEJA OCCUPER -- limiter les heures -->
                        <input type="submit" name="submit" value="Modifier" class="btn btn-outline-primary float-right mt-3">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
