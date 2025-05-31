<?php
include("connexion.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id_proposition'])) {
    $id = intval($_POST['id_proposition']);
    $action = $_POST['action'];
//echo $id;
    try {
        // Récupérer la proposition
        $stmt = $bdd->prepare("SELECT * FROM activite_proposee WHERE id_proposition = ?");
        $stmt->execute([$id]);
        $proposition = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$proposition) {
            echo "❌ Proposition introuvable.";
            exit;
        }

        if ($action === 'valider') {
            // Insérer dans la table "activite"
            $insert = $bdd->prepare("INSERT INTO activite (nom, description, prix, lien_video, niveau_requis, id_resp)
                                     VALUES (?, ?, ?, ?, ?, NULL)");
            $insert->execute([
                $proposition['nom'],
                $proposition['description'],
                $proposition['prix'],
                $proposition['lien_video'],
                $proposition['niveau_requis']
            ]);

            echo "<p style='color:green;'>✅ Activité validée et ajoutée avec succès.</p>";

        } elseif ($action === 'refuser') {
            $update = $bdd->prepare("UPDATE activite_proposee SET statut = 'refusee' WHERE id_proposition = ?");
            $update->execute([$id]);
            echo "<p style='color:orange;'>❌ Proposition refusée.</p>";

        } elseif ($action === 'supprimer') {
            $delete = $bdd->prepare("DELETE FROM activite_proposee WHERE id_proposition = ?");
            $delete->execute([$id]);
            echo "<p style='color:red;'>🗑️ Proposition supprimée.</p>";

        


        }else {
            echo "⚠️ Action non reconnue.";
        }

    } catch (PDOException $e) {
        echo "❌ Erreur : " . $e->getMessage();
    }

} else {
    echo "⚠️ Requête invalide.";
}
?>

