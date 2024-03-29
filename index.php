<!DOCTYPE html>

<html>
<?php
    include 'header.php';
    if (function_exists('customPageHeader')){
      customPageHeader('Accueil');
    }?>
                <div class="container">
                <div class=" d-flex  justify-content-evenly " style="margin-top: 18px;">

                <!-- TODO php function to generate cards -->
                    <div class="card " style="width: 18rem;">
                        <img class="card-img-top img-thumbnail img-fluid" src="./assets/patient.png" alt="Icon patient">
                            <div class="card-body">
                                <h5 class="card-title">Gestion des patients</h5>
                                <p class="card-text">Liste des patients de l'hopital permettant d'afficher leur profil ainsi que leur médecin responsable.</p>
                                <a href="./ListePatients.php" class="btn btn-primary">Voir la liste</a>
                            </div>
                    </div>
                    
                <!-- TODO php function to generate cards -->
                <div class="card " style="width: 18rem;">
                        <img class="card-img-top img-thumbnail img-fluid" src="./assets/docteur.png" alt="Icon medecin">
                            <div class="card-body">
                                <h5 class="card-title">Gestion des Medecins</h5>
                                <p class="card-text">Liste des medecins de l'hopital permettant d'afficher leur profil ainsi que leur médecin responsable.</p>
                                <a href="./ListeMedecin.php" class="btn btn-primary">Voir la liste</a>
                            </div>
                    </div>

                    <div class="card " style="width: 18rem;">
                        <img class="card-img-top img-thumbnail img-fluid" src="./assets/RDV_icon.png" alt="Icon rdv">
                            <div class="card-body">
                                <h5 class="card-title">Gestion des RDVs</h5>
                                <p class="card-text">Liste des rendez-vous de l'hopital permettant d'afficher quel patient à rendez-vous avec qui, quand et pour quelle durée.</p>
                                <a href="./ListeRDV.php" class="btn btn-primary">Voir la liste</a>
                            </div>
                    </div>
                </div>
                <div class=" d-flex  justify-content-evenly " style="margin-top: 18px;">

                    <div class="card " style="width: 18rem;">
                        <img class="card-img-top img-thumbnail img-fluid" src="./assets/statistiques.png" alt="Icon stats">
                            <div class="card-body">
                                <h5 class="card-title">Statistiques</h5>
                                <p class="card-text">Liste des rendez-vous de l'hopital permettant d'afficher quel patient à rendez-vous avec qui, quand et pour quelle durée.</p>
                                <a href="./Statistiques.php" class="btn btn-primary">Voir la liste</a>
                            </div>
                    </div>

                    <div class="card " style="width: 18rem;">
                        <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                    </div>

                    <div class="card " style="width: 18rem;">
                        <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                    </div>
                </div>
                </div>
                </body>
                </html>
            
