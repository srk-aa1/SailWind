<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_entraineur'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $degre = $_POST['degre'];
    $experience = $_POST['experience'];
    $niveau_encadrement = $_POST['niveau_encadrement'];

    // 1. Mise à jour de la table personne
    $stmt1 = $bdd->prepare("UPDATE personne SET nom = ?, prenom = ? WHERE id = ?");
    $stmt1->execute([$nom, $prenom, $id]);
     // 2. Mise à jour de la table entraineur
     $stmt2 = $bdd->prepare("UPDATE entraineur SET degre = ?, experience = ?, niveau_encadrement = ? WHERE id_entraineur = ?");
     $stmt2->execute([$degre, $experience, $niveau_encadrement, $id]);
 

     // Redirection
     header("Location: liste_entraineurs.php");
     exit();
}
?>