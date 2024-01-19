
<?php
include 'header.php';
if (function_exists('customPageHeader')){
customPageHeader('Error');
}?>
<div class="container-fluid">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <h1 class="title-2">Erreur</h1>
            <p>Le patient ou le médecin est déjà occupé à ce moment là</p>
            <a href="./ListeRDV.php" class="btn btn-primary">Retour</a>
        </div>
        <div class="col-4"></div>
    </div>
</div>
