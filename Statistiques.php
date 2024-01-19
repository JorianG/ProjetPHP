<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php

use class\Medecin;

    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/header.php";


    if (function_exists('customPageHeader')){
      customPageHeader('Statistiques');
    }

    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/StatService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Medecin.php";

    $serviceMedecin = new service\MedecinService();
    $serviceStat = new service\StatService();
    
    ?>
    <title>Statistiques</title> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Age', 'Percentage'],
          ['-25 ans',     <?php echo $serviceStat->getNbPatientBetweenAge(0, 25) ?>],
          ['25-50 ans',      <?php echo $serviceStat->getNbPatientBetweenAge(26, 50) ?>],
          ['+50 ans',  <?php echo $serviceStat->getNbPatientBetweenAge(51, 999) ?>],
          
        ]);

        var options = {
          title: 'Répartition des patients par âge'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    
</head>
<body>
    <div class="container mt-4 rounded" style="background-color: #048abf38 !important;">
        <div class="row p-2">
        <h1 class="title-2 m-1">Répartiton des patients</h1>
            <div class="col-6">
                <table class="table table-striped mt-3 ">
                    <thead>
                        <tr>
                        <th scope="col">Age</th>
                        <th scope="col">Homme</th>
                        <th scope="col">Femme</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        

                        echo '<tr>
                        <th scope="row">Moins de 25 ans</th>';
                        echo '<td>'.  $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::M, 0, 25) .' </td>';
                        echo '<td>'.  $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 0, 25) + $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::MME, 0, 25) .' </td>';
                        
                        echo '</tr>
                        <tr>
                        <th scope="row">Entre 25 et 50 ans</th>';
                        echo '<td>'.  $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::M, 26, 50) .' </td>';
                        echo '<td>'.  $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 26, 50) + $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::MME,26, 50) .' </td>';
                        
                        echo'</tr>
                        <tr>
                        <th scope="row">Plus de 50 ans</th>';
                        echo '<td>'.  $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::M, 51, 9999) .' </td>';
                        echo '<td>'.  $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 51, 9999) + $serviceStat->getNbPatientBySexeBetweenAge(class\Civilite::MME, 51, 9999) .' </td>';
                        ?>
                        </tr>

                    </tbody>
                </table>
                
            </div>
            <div class="col-6">
            <div class="m-2" id="piechart" style="width: 400px; height: 200px;"></div>
            </div>
        </div>

        
    
    </div>

    <div class="container mt-4 rounded" style="background-color: #9FB2B7 !important;">
        <div class="row p-2">
        <h1 class="title-2 m-1">Répartiton des heures de consultations</h1>
            <div class="col-6">
                <table class="table table-striped mt-3 ">
                    <thead>
                        <tr>
                        <th scope="col">Medecin</th>
                        <th scope="col">Heures de consutations (en heures)</th>
                        
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach($serviceMedecin->getAll() as $row){
                            $medecin = Medecin::newFromRow($row);
                            $medecin->setIdPersonne($row['Id_Personne']);
                            echo '<tr>
                            <th scope="row">['.$medecin->getSpecialite().'] '. $medecin->getNom() .' '. $medecin->getPrenom() .'</th>';
                            echo '<td>'.  $serviceStat->minuteToHeure($serviceStat->getNbHeuresConsultationByMedecin($medecin)).' </td>';
                            echo '</tr>';
                        }

                        ?>
                        <tr>
                        

                    </tbody>
                </table>
                
            </div>
            <div class="col-6">
            <div class="m-2" id="piechart" style="width: 400px; height: 200px;"></div>
            </div>
        </div>

        
    
    </div>
    
</body>
</html>
