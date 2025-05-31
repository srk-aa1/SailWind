<?php
include("connexion.php");

if (!isset($_GET['id'])) {
    echo "ID de l'activité manquant.";
    exit;
}

$id = $_GET['id'];

// Récupérer les infos de l'activité
$stmt = $bdd->prepare("SELECT * FROM activite a JOIN session s ON a.id_act = s.id_act WHERE s.id_sess = ?");
$stmt->execute([$id]);
$act = $stmt->fetch();

if (!$act) {
    echo "Activité non trouvée.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie_sess'];
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];

    // Mise à jour de l'activité
    $stmt1 = $bdd->prepare("UPDATE activite SET nom = ?, description = ?, prix = ? WHERE id_act = ?");
    $stmt1->execute([$nom, $description, $prix, $act['id_act']]);

    // Mise à jour de la session
    $stmt2 = $bdd->prepare("UPDATE session SET categorie_sess = ?, date = ?, heure_debut = ?, heure_fin = ? WHERE id_sess = ?");
    $stmt2->execute([$categorie, $date, $heure_debut, $heure_fin, $id]);
   
    header("Location: Gestion_des_activites.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une activité</title>
</head>
<body>
    <h2>✏️ Modifier l'Activité</h2>
    <form method="POST">
        <label>Nom:</label><br>
        <input type="text" name="nom" value="<?= htmlspecialchars($act['nom']) ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required><?= htmlspecialchars($act['description']) ?></textarea><br><br>

        <label>Prix (DA):</label><br>
        <input type="number" name="prix" value="<?= $act['prix'] ?>" required><br><br>

        <label>Catégorie de session:</label><br>
        <input type="text" name="categorie_sess" value="<?= htmlspecialchars($act['categorie_sess']) ?>" required><br><br>

        <label>Date:</label><br>
        <input type="date" name="date" value="<?= $act['date'] ?>" required><br><br>

        <label>Heure début:</label><br>
        <input type="time" name="heure_debut" value="<?= $act['heure_debut'] ?>" required><br><br>

        <label>Heure fin:</label><br>
        <input type="time" name="heure_fin" value="<?= $act['heure_fin'] ?>" required><br><br>

        <button type="submit" >✅ Modifier</button>
    </form>
</body>
</html>

