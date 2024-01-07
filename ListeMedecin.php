<!DOCTYPE html>

<html>
<?php
    include './/header.php';


    if (function_exists('customPageHeader')){
      customPageHeader('Liste des medecins');
    }?>
                

            




                <div class=" container " style="margin-top: 18px;">
                <h1 class="title-2">Ajouter un patient</h1>

                    <form class=""method="post" action="./GestionMedecin/AjouterMedecin.php" >
                        <div class="row">
                            <div class="col-1">
                                <label class="floatingInput"for="civ">Civilité:</label>
                                <select class="form-control from-select" name="civ" >
                                    <option value="MR">Mr</option>
                                    <option value="MME">Mme</option>
                                    <option value="MLLE">Mlle</option>  
                                </select>
                            </div>

                            <div class="col-5">
                                <label class="floatingInput"for="prenom">Prénom:</label>
                                <input class="form-control" type="text" name="prenom"  id="floatingInput" placeholder="Jean" required>
                
                            </div>

                            <div class="col">
                                <label for="nom">Nom:</label>
                                <input class="form-control" type="text" name="nom" placeholder="Dupont"  required>

                            </div>
                        </div>

                            <div class="row">
                                <div class="col-2">
                                <label for="dateN">Spécialité:</label>
                                <input class="form-control" type="text" name="spe" required>
                                </div>
                                
                                
                            </div>
                            <input class=" mt-2 btn btn-outline-primary btn-lg" type="submit" name="submit" value="Ajouter">
                    </form>



                    <hr class="hr hr-blurry" />
                    <br/>
                    
                    <table class="table  table-condensed table-hover">
                            <thead>
                                <tr>
                                <th scope="col">Civ</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Specialité</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>


                            <?php
                                // $result =[];
                                // include("PDO.php");
                                // $conn = getInstance();
                                // $sql = "SELECT * FROM Medecin, Personne WHERE Medecin.Id_Personne = Personne.Id_Personne";
                                // $sth = $conn->query($sql);
                                // $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
                                include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";
                                $service = new service\MedecinService();
                                $result = $service->getAll();



                                function arrayToTable($data){
                                    foreach ($data as $row) {
                                        $html = '';
                                        $html .= '<tr>';
                                        
                                        $html .= '<td >'.$row['Civilite'].'</td>';
                                        $html .= '<td >'.$row['Nom'].'</td>';
                                        $html .= '<td >'.$row['Prenom'].'</td>';
                                        $html .= '<td >'.$row['Specialite'].'</td>';
                                        $html .= '
                                        <td >
                                            <form action="./ProfilMedecin.php" method="get">
                                                <input type="hidden" name="id_med"  value="'.$row['Id_Personne'].'"></input>
                                                <button class="btn btn-primary p-2"type="submit">
                                                    <i class="bi bi-person-bounding-box"></i>
                                                </button>

                                            </form>
                                        </td>';
                                        $html .= '
                                        <td >
                                            <form action="./GestionPatient/SuprMedecin.php" method="post">
                                                <input type="hidden" name="id_med"  value="'.$row['Id_Personne'].'"></input>
                                                <button class="btn btn-secondary p-2" type="submit">
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
            
