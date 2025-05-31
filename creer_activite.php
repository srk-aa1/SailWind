<?php
include("connexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Génération d'ID uniques
        $id_act = uniqid("A");
        $id_sess = uniqid("S");
        $id_lieu = uniqid("L");

        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $lien_video = $_POST['lien_video'];
        $niveau_requis = $_POST['niveau_requis'];
        $date = $_POST['date'];
        $heure_debut = $_POST['heure_debut'];
        $heure_fin = $_POST['heure_fin'];
        $lieu = $_POST['lieu']; // adresse du lieu

        // Vérification de conflit horaire
        $check = $bdd->prepare("SELECT COUNT(*) FROM session
            WHERE date = :date AND (
                (:heure_debut BETWEEN heure_debut AND heure_fin) OR
                (:heure_fin BETWEEN heure_debut AND heure_fin) OR
                (heure_debut BETWEEN :heure_debut AND :heure_fin)
            )");
        $check->execute([
            'date' => $date,
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin
        ]);

        if ($check->fetchColumn() > 0) {
            echo "<p style='color:red;'>⛔ Conflit d’horaire : une autre session est déjà prévue à cette date et heure. Veuillez modifier l’horaire.</p>";
            exit;
        }

        // Insertion dans table lieu
        $insert_lieu = $bdd->prepare("INSERT INTO lieu (id_lieu, adresse) VALUES (:id_lieu, :adresse)");
        $insert_lieu->execute([
            'id_lieu' => $id_lieu,
            'adresse' => $lieu
        ]);

        // Insertion dans activite
        $insert_act = $bdd->prepare("INSERT INTO activite (id_act, nom, description, prix, lien_video, niveau_requis)
            VALUES (:id_act, :nom, :description, :prix, :lien_video, :niveau_requis)");
        $insert_act->execute([
            'id_act' => $id_act,
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'lien_video' => $lien_video,
            'niveau_requis' => $niveau_requis
        ]);

        // Insertion dans session
        $insert_sess = $bdd->prepare("INSERT INTO session (id_sess, date, heure_debut, heure_fin, id_act)
            VALUES (:id_sess, :date, :heure_debut, :heure_fin, :id_act)");
        $insert_sess->execute([
            'id_sess' => $id_sess,
            'date' => $date,
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin,
            'id_act' => $id_act
        ]);

        // Insertion dans se_deroule
        $insert_link = $bdd->prepare("INSERT INTO se_deroule (id_sess, id_lieu) VALUES (:id_sess, :id_lieu)");
        $insert_link->execute([
            'id_sess' => $id_sess,
            'id_lieu' => $id_lieu
        ]);

        echo "<p style='color:green;'>✅ Activité, session et lieu créés avec succès !</p>";

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<!-- ✅ Formulaire HTML -->
<form method="POST">
    <label>Nom :</label><input type="text" name="nom" required><br>
    <label>Description :</label><textarea name="description" required></textarea><br>
    <label>Date :</label><input type="date" name="date" required><br>
    <label>Heure début :</label><input type="time" name="heure_debut" required><br>
    <label>Heure fin :</label><input type="time" name="heure_fin" required><br>
    <label>Lieu (adresse) :</label><input type="text" name="lieu" required><br>
    <label>Prix :</label><input type="number" name="prix" step="0.01" required><br>
    <label>Lien vidéo :</label><input type="url" name="lien_video"><br>
    <label>Niveau requis :</label><input type="text" name="niveau_requis"><br>
    <button type="submit">Créer l’activité</button>
</form>




        
    