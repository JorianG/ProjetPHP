<?php

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/CompteService.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    $service = new service\CompteService();

    if ($service->accessGranted($login, $pwd)) {
        session_start();
        $_SESSION['login'] = $login;
        
        header('Location: /ProjetPHP/index.php');
    } else {
        header('Location: /ProjetPHP/conn.php');
    }
}

?>
