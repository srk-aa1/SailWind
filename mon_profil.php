<?php
session_start();
include("connexion.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $date_naissance = $_POST['date_naissance'];

    // Update dans la table "personne"
    $stmt = $bdd->prepare("UPDATE personne SET nom = ?, prenom = ?, telephone = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom,$telephone, $id]);

    // Update dans la table "membre" (si existant)
    $stmt2 = $bdd->prepare("UPDATE membre SET date_naissance = ? WHERE id_membre = ?");
    $stmt2->execute([$date_naissance, $id]);

    echo "<p style='color: green;'>Profil mis à jour avec succès.</p>";
}

// Récupérer les infos actuelles pour affichage dans le formulaire
$stmt = $bdd->prepare("SELECT * FROM personne LEFT JOIN membre ON personne.id = membre.id_membre WHERE personne.id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
  <link rel="stylesheet" href="accueil.css">
    
  <style>
   

    /* Formulaire */
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #023e8a;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-top: 15px;
      color: #333;
    }

    input[type="text"],
    input[type="date"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-top: 5px;
    }

    button {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      background-color: #0077b6;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #023e8a;
    }

  </style>
</head>
<body>
  <!-- Navbar -->
  <header>
    <nav class="navbar">
      <img src="Logo-SailWind.png" alt="Logo" class="logo">
      <!--<div class="logo">SailWind</div>-->
      <ul class="nav-links">
        <li><a href="espace_membre.php">Accueil</a></li>
    
        <li><a href="mon_profil.php">Mon profil</a></li>
        
      <li><a href="logout.php">Se déconnecter</a></li>

      </ul>
    </nav>
  </header>

  <div class="container">
    <h2>Mon Profil</h2>

    <form method="POST" action="update_profil.php">
      <label>Nom :</label>
      <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>

      <label>Prénom :</label>
      <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>

      <label>Date de naissance :</label>
      <input type="date" name="date_naissance" value="<?= htmlspecialchars($user['date_naissance'] ?? '') ?>">

      <label>Téléphone :</label>
      <input type="text" name="telephone" value="<?= htmlspecialchars($personne['email'] ?? '') ?>">

      <label>Catégorie membre :</label>
      <input type="text" name="categorie_membre" value="<?= htmlspecialchars($membre['categorie_membre'] ?? '') ?>">

      <button type="submit" name="update">Mettre à jour</button>
    </form>
  </div>

  
  <!-- Footer -->
  <footer>
    <div class="footer-col">
      <h3>Nous contacter</h3>
      <p><img src="img/icone location.jpg"> Annaba, Algérie</p>
      <p><img src="img/icone phone.jpg"> +213 123 456 789</p>
      <p><img src="img/icone mail.jpg"> contact@sailwind.dz</p>
    </div>
    <div class="footer-col">
      <h3>Paiements</h3>
      <p>Pour les paiements, veuillez contacter le : 
        <br>+213 123 456 789</p>
    </div>
   
  </footer>


</body>
</html>