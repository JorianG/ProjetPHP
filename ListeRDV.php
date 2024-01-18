<?php
    include './/header.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/RDVService.php";

    if (function_exists('customPageHeader')) {
        customPageHeader('Liste des Rendez-vous');
    }

    if (isset($_POST["id_med"])) {
        $table = $_POST["id_med"];
    }
    ?>
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
                <label class="col-sm-4 col-form-label-sm" for="date">Date :</label>
                <div class="col-sm-12">
                    <input class="form-control form-control-sm" type="date" name="date" id="" required>
                </div>
            </div>
            <div class="form-group col-4 mb-2">
                <label class="col-sm-4 col-form-label-sm" for="heure">Heure :</label>
                <div class="col-sm-12">
                    <input class="form-control form-control-sm" type="time" min='8:00' max='18:00' name="heure" id="" required>
                </div>
            </div>
            <div class="form-group col-4 mb-2">
                <label class="col-sm-4 col-form-label-sm" for="duree">Durée : (en Minutes)</label>
                <div class="col-sm-12">
                    <input class="form-control form-control-sm" type="number" name="duree" min='0' max='120' step='5' pattern='[0-9]+' id="" required>
                </div>
            </div>
        </div>
        <input class=" mt-2 btn btn-outline-primary btn-lg" type="submit" name="submit" value="Ajouter">
    </form>

    <hr class="hr hr-blurry" />


    <div class="row">
        <form class="col-12" action="./ListeRDV.php?>." method="post">
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label" for="date">Filtre par Médecin :</label>
            </div>
            <div class="row">
                <div class="col-2">
                    <?php
                    echo "<select class='form-control form-control-sm' name='id_med' id=''>";
                        if ($table != null) {
                            $serviceMedecin = new \service\MedecinService();
                            $medecin = $serviceMedecin->getById($table);
                            $medecin->setIdPersonne($table);
                            echo '<option value="'.$medecin->getIdPersonne().'"> ['.$medecin->getSpecialite().'] '.$medecin->getNom().' '.$medecin->getPrenom().'</option>';
                            echo "<option value=''>Aucun</option>";
                        } else {
                            echo "<option value=''>Aucun</option>";
                        }
                    $service = new \service\MedecinService();
                    $result = $service->getAll();
                    foreach ($result as $row) {
                        echo '<option value="'.$row['Id_Personne'].'"> ['.$row['Specialite'].'] '.$row['Nom'].' '.$row['Prenom'].'</option>';
                    }
                    echo "</select>"
                    ?>
                </div>
                <div class="col-9"></div>
                <input class="col-1 btn btn-primary" type="submit" name="submit" value="Filtrer">
            </div>

        </form>
    </div>

    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th scope="col">Médecin</th>
                <th scope="col">Patient</th>
                <th scope="col">Date</th>
                <th scope="col">Durée</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

        <?php
            echo $table;
            if ($table != null) {
                $serviceRDV = new \service\RDVService();
                $serviceMedecin = new \service\MedecinService();
                $medecin = $serviceMedecin->getById($table);
                $medecin->setIdPersonne($table);
                $result = $serviceRDV->selectAllByMedecin($medecin);
            } else {
                $serviceRDV = new \service\RDVService();
                $result = $serviceRDV->selectAll();
            }

            function arrayToTable($data){
                $servicePatient = new \service\PatientService();
                $serviceMedecin = new \service\MedecinService();
                foreach ($data as $row) {
                    $m = $serviceMedecin->getById($row['Id_Personne_id_medecin']);
                    $p = $servicePatient->getById($row['Id_Personne_Id_Patient']);
                    $html = '';
                    $html .= '<tr>';

                    $html .= '<td >'.$m->getNom().' '.$m->getPrenom().'</td>';
                    $html .= '<td >'.$p->getNom().' '.$p->getPrenom().'</td>';
                    $html .= '<td >'.$row['DateHeure'].'</td>';
                    $html .= '<td >'.$row['DureeEnM'].'</td>';
                    $html .= '
                        <td >
                            <form action="./RDV.php" method="get">
                                <input type="hidden" name="id_rdv"  value="'.$row['Id_RDV'].'"/>
                                <button class="btn btn-primary p-2" type="submit">
                                    <i class="bi bi-person-bounding-box"></i> 
                                </button>
                            </form>
                        </td>';
                    $html .= '
                        <td >
                            <form action="./GestionRDV/SupprimerRDV.php" method="post">
                                <input type="hidden" name="id_rdv"  value="'.$row['Id_RDV'].'"/>
                                <button class="btn secondary p-2" type="submit">
                                    <i class="bi bi-trash3"></i> 
                                </button>
                            </form>
                        </td>';
                    $html .= '</tr>';
                    echo $html;
                }
            }
            arrayToTable($result);
        ?>

        </tbody>

    </table>
</div>