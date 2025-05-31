<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $degre = $_POST['degre'];
    $experience = $_POST['experience'];
    $niveau_encadrement = $_POST['niveau_encadrement'];

    // 1. Insérer dans la table `personne`

    $stmt1 = $bdd->prepare("INSERT INTO personne (nom, prenom) VALUES (?, ?)");
    $stmt1->execute([$nom, $prenom]);

    // 2. Récupérer l'id-personne généré
    $id = $bdd->lastInsertId();

    // 3. Insérer dans la table `entraineur` avec id de personne
    $stmt2 = $bdd->prepare("INSERT INTO entraineur (id_entraineur, degre, experience, niveau_encadrement)
                            VALUES (?, ?, ?, ?)");
    $stmt2->execute([$id, $degre, $experience, $niveau_encadrement]);

    header("Location: liste_entraineurs.php");
    exit();
}
?>
