<?php

echo "
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Ajout patient</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href=''>
     </head>
     <body>
        <h1>Ajout patient</h1>
        <form action='../pages/AjoutPatient.php' method='post'>
            <label for='numerodesecu'>Numéro de sécurité sociale : </label>
            <input type='number' name='numSecu', id='numSecu' required><br><br>
            <label for='nom'>Nom : </label>
            <input type='text' name='nom' id='nom' required>
            <label for='civilite'>Civilité : </label>
            <select name='civilite' id='civilite'>
                <option value='Monsieur'>Monsieur</option>
                <option value='Madame'>Madame</option>
            </select><br><br>
            <label for='prenom'>Prénom : </label>
            <input type='text' name='prenom' id='prenom' required><br><br>
            
            <label for='datedenaissance'>Date de naissance : </label>
            <input type='date' name='datedenaissance' id='datedenaissance' required><br><br>
            
            <label for='lieudenaissance'>Lieu de naissance : </label>
            <input type='text' name='lieudenaissance' id='lieudenaissance' required><br><br>
            
            <label for='adresse'>Adresse : </label>
            <input type='text' name='adresse' id='adresse' required><br><br>
            
            <input type='submit' value='Ajouter'>
        </form>
     </body>
";
