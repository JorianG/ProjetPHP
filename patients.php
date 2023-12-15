<!DOCTYPE html>

<html>
<?php
    include 'header.php';
    if (function_exists('customPageHeader')){
      customPageHeader();
    }?>
                
                <div class=" container " style="margin-top: 18px;">
                <form action="AjouterPatient.php">
                    <button class="btn btn-primary mb-3" href="http://localhost/projetPHP/AjouterPatient.php">Ajouter patient</button>
                    
                    </form>
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
                                $sql = "SELECT * FROM Patient, Personne WHERE Patient.Id_Personne = Personne.Id_Personne";
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
            
