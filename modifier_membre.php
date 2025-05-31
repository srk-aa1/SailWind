<?php
session_start();
include("connexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les infos du membre
    $stmt = $bdd->prepare("SELECT p.*, m.date_naissance, m.categorie_membre
                           FROM personne p
                           JOIN membre m ON p.id = m.id
                           WHERE p.id = ?");
    $stmt->execute([$id]);
    $membre = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des membres</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="accueil.css">
    <style>
        

a {
    text-decoration: none;
    color: inherit;
}



 h2 {
            text-align: center;
            margin-bottom: 30px;
            color:  #007BFF;
        }

        form {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 500;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        input[type="submit"] {
            margin-top: 25px;
            padding: 12px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
 <!-- Navbar -->
  <header>
    <nav class="navbar">
      <img src="Logo-SailWind.png" alt="Logo" class="logo">
      
      <ul class="nav-links">
        <li><a href="espace_responsable.php">Accueil</a></li>
       
        <li><a href="logout.php">Se déconnecter</a></li>

      </ul>
    </nav>
  </header>

  <br>
<h2>Modifier le membre</h2>
<form method="POST" action="update_membre.php">
    <input type="hidden" name="id" value="<?= $membre['id'] ?>">
   <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($membre['nom']) ?>" required>

    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($membre['prenom']) ?>" required>

    <label>Email :</label>
    <input type="email" name="email" value="<?= htmlspecialchars($membre['email']) ?>" required>

    <label>Téléphone :</label>
    <input type="text" name="telephone" value="<?= htmlspecialchars($membre['telephone']) ?>">

    <label>Date de naissance :</label>
    <input type="date" name="date_naissance" value="<?= htmlspecialchars($membre['date_naissance']) ?>">

    <label>Catégorie :</label>
    <select name="categorie_membre" required>
        <option value="débutant" <?= $membre['categorie_membre'] === 'débutant' ? 'selected' : '' ?>>Débutant</option>
        <option value="intermédiaire" <?= $membre['categorie_membre'] === 'intermédiaire' ? 'selected' : '' ?>>Intermédiaire</option>
        <option value="avancé" <?= $membre['categorie_membre'] === 'avancé' ? 'selected' : '' ?>>Avancé</option>
    </select>

    <input type="submit" value="Mettre à jour">
</form>
    <br>
<!-- Footer -->
  <footer>
    <div class="footer-col">
      <h3>Nous contacter</h3>
      <p><img src="assets/location.svg"> Annaba, Algérie</p>
      <p><img src="assets/phone.svg"> +213 123 456 789</p>
      <p><img src="assets/mail.svg"> contact@sailwind.dz</p>
    </div>
    <div class="footer-col">
      <h3>Paiements</h3>
      <p>Pour les paiements, veuillez contacter le : 
        <br>+213 123 456 789</p>
    </div>
   
  </footer>
</body>
</html>
