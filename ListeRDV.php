<?php
    include './/header.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";

    if (function_exists('customPageHeader')) {
        customPageHeader('Liste des Rendez-vous');
    }?>
    <div class=" container-fluid container  " style="margin-top: 10px;">
    <!-- formulaire d'ajout de RDV -->
    <h1 class="title-2">Ajouter un Rendez-Vous</h1>

    <form method="post", action="./GestionRDV/AjoutRDV.php">
        <div class="row">
        <?php
        echo "
        <div class='form-group col-6 mb-2'>
            <label class='col-sm-4 col-form-label-sm' for='med'> Médecin :</label>
            <div class='col-sm-12'>
                <select class='form-control form-control-sm' name='med' id='' required >";
                    echo "<option value=''>Aucun</option>";
                    $service = new \service\MedecinService();
                    $result = $service->getAll();
                    foreach ($result as $row) {
                    echo '<option value="'.$row['Id_Personne'].'"> ['.$row['Specialite'].'] '.$row['Nom'].' '.$row['Prenom'].'</option>';
                    }
                    echo "</select>
            </div>
        </div>";
        echo "
        <div class='form-group col-6 mb-2'>
            <label class='col-sm-4 col-form-label-sm'>Patient : </label>
            <div class='col-sm-12'>
                <select class='form-control form-control-sm' name='pat' id='' required>";
                    echo "<option value=''>Aucun</option>";
                    $service = new \service\PatientService();
                    $result = $service->getAll();
                    foreach ($result as $row) {
                    echo '<option value="'.$row['Id_Personne'].'">'.$row['Nom'].' '.$row['Prenom'].'</option>';
                    }
                    echo "</select>
            </div>
        </div>";
                    ?>
        </div>
        <div class="row">
            <div class="form-group col-4 mb-2">
                <label class="col-sm-4 col-form-label-sm" for="heure">Heure :</label>
                <div class="col-sm-12">
                    <input class="form-control form-control-sm" type="time" name="heure" id="" required>
                </div>
            </div>
            <div class="form-group col-4 mb-2">
                <label class="col-sm-4 col-form-label-sm" for="date">Date :</label>
                <div class="col-sm-12">
                    <input class="form-control form-control-sm" type="date" name="date" id="" required>
                </div>
            </div>
            <div class="form-group col-4 mb-2">
                <label class="col-sm-4 col-form-label-sm" for="duree">Durée :</label>
                <div class="col-sm-12">
                    <input class="form-control form-control-sm" type="time" name="duree" id="" required> <!-- TODO limiter à 3h -->
            </div>
        </div>
    </form>
    </div>