use PDO; // Import the PDO class from the global namespace
<?php
    


    //CONNEXION A LA BD 
    $conn = null;

    function getInstance() : PDO{
        if(!isset($conn)){
            $host = 'localhost';
            $db_name = 'projet';
            $username = 'client_projet';
            $password = 'iutinfo';
            try {
                $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<script>console.log('Connexion à la base de donnée réussie');</script>";
            } catch(PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
            
        }
        return $conn;
    }
?>