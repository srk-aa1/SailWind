<?php
session_start();
if (!isset($_SESSION['id_membre'])) {
    header("Location: login.php");
    exit();
}

include("connexion.php");

$id_membre = $_SESSION['id_membre'];
$id_sess = $_POST['id_sess'] ?? null;

if (!$id_sess) {
    header("Location: reserver_session.php?msg=erreur");
    exit();
}

// Vérifier si la réservation existe déjà
$sql_check = "SELECT * FROM reservation WHERE id_membre = ? AND id_sess = ?";
$stmt_check = $bdd->prepare($sql_check);
$stmt_check->execute([$id_membre, $id_sess]);

if ($stmt_check->rowCount() > 0) {
    header("Location: reserver_session.php?msg=deja_reservee");
    exit();
} else {
    // Ajouter la réservation avec statut 'en attente'
    $sql_insert = "INSERT INTO reservation (id_membre, id_sess, statut) VALUES (?, ?, 'en attente')";
    $stmt_insert = $bdd->prepare($sql_insert);
    $stmt_insert->execute([$id_membre, $id_sess]);
    if ($stmt_insert->execute([$id_membre, $id_sess])){
        echo " Reservation effectuée avec succès ! ";

    }else{
        echo " Erreur lors de l'insertion. ";
    }
    // ✅ Rediriger avec message
    header("Location: espace_membre.php?msg=reservation_effectuee");
    exit();
}

?>