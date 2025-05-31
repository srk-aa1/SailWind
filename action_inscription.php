<?php
session_start();
include("connexion.php");

// Vérifier si l'utilisateur est bien connecté comme responsable
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'responsable') {
    header("Location: login.php?erreur=acces_non_autorise");
    exit;
}

// Vérifier que les champs sont bien envoyés
if (isset($_POST['id_reserv'], $_POST['action'])) {
    $id_reserv = (int) $_POST['id_reserv'];
    $action = $_POST['action'];

    // Déterminer le nouveau statut
    if ($action === 'accepter') {
        $nouveau_statut = 'confirmee';
    } elseif ($action === 'refuser') {
        $nouveau_statut = 'refusee';
    } else {
        header("Location: gerer_inscriptions.php?msg=action_invalide");
        exit;
    }

    // Mettre à jour le statut de la réservation
    try {
        $sql = "UPDATE reservation SET statut = :statut WHERE id_reserv = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            ':statut' => $nouveau_statut,
            ':id' => $id_reserv
        ]);

        header("Location: gerer_inscriptions.php?msg=" . urlencode($action));
        exit;
    } catch (PDOException $e) {
        header("Location: gerer_inscriptions.php?msg=erreur_bdd");
        exit;
    }
} else {
    // Redirection si les données sont incomplètes
    header("Location: gerer_inscriptions.php?msg=données_invalides");
    exit;
}
?>