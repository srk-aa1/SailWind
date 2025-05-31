<?php
session_start();

if (!isset($_SESSION['id_membre'])) {
    header("Location: login.php");
    exit();
}

include("connexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reserv = $_POST['id_reserv'] ?? null;
    $id_membre = $_SESSION['id_membre'];

    if ($id_reserv) {
        // Vérifier que la réservation appartient bien au membre connecté
        $sql_check = "SELECT * FROM reservation WHERE id_reserv = ? AND id_membre = ?";
        $stmt_check = $bdd->prepare($sql_check);
        $stmt_check->execute([$id_reserv, $id_membre]);

        if ($stmt_check->rowCount() > 0) {
            // Supprimer la réservation
            $sql_delete = "DELETE FROM reservation WHERE id_reserv = ?";
            $stmt_delete = $bdd->prepare($sql_delete);
            $stmt_delete->execute([$id_reserv]);

            header("Location: mes_reservations.php?msg=Réservation annulée avec succès.");
            exit();
        } else {
            header("Location: mes_reservations.php?msg=Réservation non trouvée ou accès refusé.");
            exit();
        }
    } else {
        header("Location: mes_reservations.php?msg=ID de réservation manquant.");
        exit();
    }
} else {
    header("Location: mes_reservations.php");
    exit();
}
?>
