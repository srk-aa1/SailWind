<?php
session_start();
include("connexion.php");

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'entraineur') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id_sess'])) {
    $id_session = $_GET['id_sess'];
    $id_entraineur = $_SESSION['id'];

    // Vérifier si cette session appartient à l'entraîneur
    $check = $bdd->prepare("SELECT * FROM encadrement WHERE id_entraineur = ? AND id_sess = ?");
    $check->execute([$id_entraineur, $id_sess]);

    if ($check->rowCount() > 0) {
        $update = $bdd->prepare("UPDATE session SET remarque = 'annulée' WHERE id_sess = ?");
        $update->execute([$id_sess]);
    }
}

header("Location: annuler_seance.php");
exit();
