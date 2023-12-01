<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@200&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light mb-10">
            <div class="container-fluid">
                <a class="navbar-brand overflow-hidden">
                    <img src="assets/logo.png" height=230 alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                <h1 class="navbar-text  titre-page">Patients</h1>
                    <div class="d-flex container-profil">
                        <p class="navbar-text navbar nom_docteur">Dr Magnaud</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle navbar" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </div>

                </div>
                </nav>

                <div class=" container d-flex bg-danger justify-content-evenly" style="margin-top: 18px;">
                
    
                    <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Civ</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Date de naissance</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>


                            <?php
                                $result =[];
                                include("PDO.php");
                                $conn = getInstance();
                                $sql = "SELECT * FROM Patient";
                                $sth = $conn->query($sql);
                                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);




                                function arrayToTable($data){
                                    foreach ($data as $row) {
                                        $html = '';
                                        $html .= '<tr>';

                                        $html .= '<td >'.$row['Civilite'].'</td>';
                                        $html .= '<td >'.$row['Nom'].'</td>';
                                        $html .= '<td >'.$row['Prenom'].'</td>';
                                        $html .= '<td >'.$row['Adresse'].'</td>';
                                        $html .= '<td >'.$row['DateNaissance'].'</td>';
                                        $html .= '
                                        <td class="row">
                                            <form action="supr.php" method="post">
                                                <input type="hidden" name="btn"  value="'.$row['Id_Personne'].'"></input>
                                                <button class="btn btn-secondary"type="submit">
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
                </body>
                </html>
            
