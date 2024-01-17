<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/ProjetPHP/service/RDVService.php";

function suprRDV(){
    $id_RDV = $_POST['id_rdv'];

    $RDVService = new service\RDVService();
    $RDVService->delete($id_RDV);

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    suprRDV();
}

header('Location: http://localhost/ProjetPHP/ListeRDV.php');