<?php
session_start();
include("connexion.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$telephone=$_POST['telephone'] ?? null;
$date_naissance = $_POST['date_naissance'] ?? null;
$categorie = $_POST['categorie_membre'] ?? null;

//mettre a jour les infos dans la table personne
$stmt_personne= $bdd ->prepare("
    UPDATE personne
    SET telephone = ?
    WHERE id = ?
");
$stmt_personne->execute([$telephone,$id]);

// Vérifie si le membre existe deja
$stmt_chek = $bdd->prepare("SELECT id_membre FROM membre WHERE id_membre = ?");
$stmt_chek->execute([$id]);
$existe = $stmt_chek->fetch();

//mise a jour ou insertion dans 'membre'
if ($existe) {
    // Mise à jour dans la table membre
    $stmt_update = $bdd->prepare("UPDATE membre SET date_naissance = ?, categorie_membre = ? WHERE id_membre = ?");
    $stmt_update->execute([$date_naissance, $categorie, $id_membre]);
} else {
    // Insertion si la ligne n'existe pas
    $stmt_insert = $bdd->prepare("INSERT INTO membre (id_membre, date_naissance, categorie_membre) VALUES (?, ?, ?)");
    $stmt_insert->execute([$id, $date_naissance, $categorie]);
}

header("Location: mon_profil.php?success=1");
exit();
?>