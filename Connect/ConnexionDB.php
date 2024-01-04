<?php
function connexion(){
    try{
        $db = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'SQL_DEV', 'iutinfo');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //teste la connexion sql
        echo "<script>console.log('Connexion à la base de donnée réussie');</script>";
        return $db;
    }
    catch(PDOException $e){
        die('Erreur : '.$e->getMessage());
    }
}
?>