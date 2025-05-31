
<?php
include("connexion.php");

$action = $_POST['action'] ?? '';
$id_sess = $_POST['id_sess'] ?? '';

if (!$id_sess) {
    echo "ID session manquant.";
    exit;
}

try {
    if ($action === "supprimer") {
        $stmt = $bdd->prepare("SELECT id_act FROM session WHERE id_sess = ?");
        $stmt->execute([$id_sess]);
        $id_act = $stmt->fetchColumn();

        $bdd->prepare("DELETE FROM se_deroule WHERE id_sess = ?")->execute([$id_sess]);
        $bdd->prepare("DELETE FROM session WHERE id_sess = ?")->execute([$id_sess]);
        $bdd->prepare("DELETE FROM activite WHERE id_act = ?")->execute([$id_act]);

        echo "✅ Activité supprimée.";
    }

    elseif ($action === "valider") {
        $bdd->prepare("UPDATE session SET remarque = 'Validée' WHERE id_sess = ?")->execute([$id_sess]);
        echo "✅ Activité validée.";
    }

    elseif ($action === "refuser") {
        $bdd->prepare("UPDATE session SET remarque = 'Refusée' WHERE id_sess = ?")->execute([$id_sess]);
        echo "❌ Activité refusée.";
    }
    
    else {
        echo "⚠️ Action non reconnue.";
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

