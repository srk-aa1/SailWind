<?php
include("connexion.php");

$id = $_GET['id'];
$stmt = $bdd->prepare("DELETE FROM entraineur WHERE id_entraineur = ?");
$stmt->execute([$id]);

header("Location: liste_entraineurs.php");
?>