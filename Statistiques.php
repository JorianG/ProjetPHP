<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/header.php";


    if (function_exists('customPageHeader')){
      customPageHeader('Statistiques');
    }

    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/StatService.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/Civilite.php";
    $service = new service\StatService();
    
    ?>
    <title>Statistiques</title> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Age', 'Percentage'],
          ['-25 ans',     <?php echo $service->getNbPatientBetweenAge(0, 25) ?>],
          ['25-50 ans',      <?php echo $service->getNbPatientBetweenAge(26, 50) ?>],
          ['+50 ans',  <?php echo $service->getNbPatientBetweenAge(51, 999) ?>],
          
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
        <div class="row">
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
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::M, 0, 25) .' </td>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 0, 25) + $service->getNbPatientBySexeBetweenAge(class\Civilite::MME, 0, 25) .' </td>';
                        
                        echo '</tr>
                        <tr>
                        <th scope="row">Entre 25 et 50 ans</th>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::M, 26, 50) .' </td>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 26, 50) + $service->getNbPatientBySexeBetweenAge(class\Civilite::MME,26, 50) .' </td>';
                        
                        echo'</tr>
                        <tr>
                        <th scope="row">Plus de 50 ans</th>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::M, 51, 9999) .' </td>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 51, 9999) + $service->getNbPatientBySexeBetweenAge(class\Civilite::MME, 51, 9999) .' </td>';
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

    <div class="container mt-4 rounded" style="background-color: #048abf38 !important;">
        <div class="row">
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
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::M, 0, 25) .' </td>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 0, 25) + $service->getNbPatientBySexeBetweenAge(class\Civilite::MME, 0, 25) .' </td>';
                        
                        echo '</tr>
                        <tr>
                        <th scope="row">Entre 25 et 50 ans</th>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::M, 26, 50) .' </td>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 26, 50) + $service->getNbPatientBySexeBetweenAge(class\Civilite::MME,26, 50) .' </td>';
                        
                        echo'</tr>
                        <tr>
                        <th scope="row">Plus de 50 ans</th>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::M, 51, 9999) .' </td>';
                        echo '<td>'.  $service->getNbPatientBySexeBetweenAge(class\Civilite::MLE, 51, 9999) + $service->getNbPatientBySexeBetweenAge(class\Civilite::MME, 51, 9999) .' </td>';
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
    
</body>
</html>
