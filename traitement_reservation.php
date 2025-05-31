<?php
session_start();
include("connexion.php");

$id_membre = $_SESSION["id_membre"] ?? null;
$id_session = $_POST["id_sess"] ?? null;

if (!$id_membre || !$id_session) {
    header("Location: login.php");
    exit();
}

// Vérifie si la réservation existe déjà
$sql = "SELECT * FROM reservation WHERE id_membre = ? AND id_sess = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id_membre, $id_sess]);

if ($stmt->rowCount() > 0) {
    echo "Vous avez déjà réservé cette activité.";
    exit();
}

// Insérer la réservation
$sql = "INSERT INTO reservation (id_membre, id_sess, statut) VALUES (?, ?, 'en attente')";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id_membre, $id_sess]);

echo "Réservation effectuée avec succès.";
echo '<br><a href="reserver_une_activite.php">Retour</a>';