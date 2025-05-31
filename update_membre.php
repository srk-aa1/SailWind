<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $telephone = $_POST['telephone'];
    $date_naissance = $_POST['date_naissance'];
    $categorie = $_POST['categorie_membre'];

    // Update table personne
    $stmt1 = $bdd->prepare("UPDATE personne SET nom = ?, prenom = ?, email = ?, mot_de_passe = ?, telephone = ? WHERE id = ?");
    $stmt1->execute([$nom, $prenom, $email, $mot_de_passe, $telephone, $id]);

    // Update table membre
    $stmt2 = $bdd->prepare("UPDATE membre SET date_naissance = ?, categorie_membre = ? WHERE id = ?");
    $stmt2->execute([$date_naissance, $categorie, $id]);

    header("Location: liste_membres.php");
    exit();
}
?>

