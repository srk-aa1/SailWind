<?php
include("connexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer d'abord de membre
    $stmt1 = $bdd->prepare("DELETE FROM membre WHERE id_membre = ?");
    $stmt1->execute([$id]);

    // Puis de personne
    $stmt2 = $bdd->prepare("DELETE FROM personne WHERE id = ?");
    $stmt2->execute([$id]);

    header("Location: liste_membres.php");
    exit();
}
?>