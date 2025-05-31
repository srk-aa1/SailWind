<?php
$host = 'localhost';      // ou 127.0.0.1
$dbname = 'sailWind_bdd';    
$username = 'root';      
$password = '';           

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // activer les erreurs
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>