<?php
session_start();
include("connexion.php");

// Vérification du rôle
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'responsable') {
    header("Location: login.php");
    exit();
}

// Récupération des membres
$stmt = $bdd->query("SELECT m.id AS id_membre, p.nom, p.prenom, p.email, p.telephone, m.categorie_membre
                     FROM membre m
                     INNER JOIN personne p ON m.id = p.id");

$membres = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des membres</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="accueil.css">
    <style>
       
/*------------------- content --------------*/


    h2 {
      text-align: center;
      color: #003366;
      margin-bottom: 30px;
    }

    table {
      width: 90%;
      border-collapse: collapse;
      margin: auto;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 15px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    th {
      background: #003366;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .btn-action {
      padding: 8px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      margin: 0 4px;
    }

    .btn-modifier {
      background-color: #4CAF50;
      color: white;
    }

    .btn-supprimer {
      background-color: #e74c3c;
      color: white;
    }

    .btn-modifier:hover, .btn-supprimer:hover {
      opacity: 0.85;
    }

    form {
      max-width: 500px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.08);
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
    }

    form input, form select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    form input[type="submit"] {
      background-color: #003366;
      color: white;
      font-weight: bold;
      margin-top: 20px;
      cursor: pointer;
    }

    form input[type="submit"]:hover {
      background-color: #002244;
    }

    .no-members {
      text-align: center;
      color: #777;
      margin-top: 30px;
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

<h2>Liste des Membres</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Catégorie</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($membres as $membre) { ?>
        <tr>
            <td><?= $membre['id_membre']; ?></td>
            <td><?= htmlspecialchars($membre['nom']); ?></td>
            <td><?= htmlspecialchars($membre['prenom']); ?></td>
            <td><?= htmlspecialchars($membre['email']); ?></td>
            <td><?= htmlspecialchars($membre['telephone']); ?></td>
            <td><?= htmlspecialchars($membre['categorie_membre']); ?></td>
            <td>
                <a class="btn-action btn-modifier" href="modifier_membre.php?id=<?= $membre['id_membre']; ?>">Modifier</a>
                <a class="btn-action btn-supprimer" href="supprimer_membre.php?id=<?= $membre['id_membre']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce membre ?');">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
    <?php if (count($membres) === 0): ?>
    <p style="text-align:center; color: #555; margin-top: 50px;">Aucun membre trouvé pour le moment.</p>
<?php endif; ?>
</table>
<br><br>

<h2>Ajouter un membre</h2>
<form action="inserer_membre.php" method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" required><br>
    <label>Prénom :</label>
    <input type="text" name="prenom" required><br>
    <label>Email :</label>
    <input type="email" name="email" required><br>
    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br>
    <label>Téléphone :</label>
    <input type="text" name="telephone"><br>
    <label>Date de naissance :</label>
    <input type="date" name="date_naissance"><br>
    <label>Catégorie membre :</label>
    <select name="categorie_membre">
        <option value="débutant">Débutant</option>
        <option value="intermédiaire">Intermédiaire</option>
        <option value="avancé">Avancé</option>
    </select><br><br>
    <input type="submit" value="Ajouter le membre">
</form>


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