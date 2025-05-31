<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //recuperation des champs mn formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $telephone = $_POST['telephone'];
    $date_naissance = $_POST['date_naissance'];
    $categorie_membre = $_POST['categorie_membre'];

    // Étape 1 : Insertion dans la table personne
    $stmt1 = $bdd->prepare("INSERT INTO personne (nom, prenom, email, mot_de_passe, telephone, role) VALUES (?, ?, ?, ?, ?, 'membre')");
    $stmt1->execute([$nom, $prenom, $email, $mot_de_passe, $telephone]);
   //recuperer l id de la personne
    $id = $bdd->lastInsertId();

    // Insérer dans membre
    $stmt2 = $bdd->prepare("INSERT INTO membre (id, date_naissance, categorie_membre) VALUES (?, ?, ?)");
    $stmt2->execute([$id, $date_naissance, $categorie_membre]);

    header("Location: liste_membres.php");
    exit();
}
?>

