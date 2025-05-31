<?php
include("connexion.php");
$entraineurs = $bdd->query("
    SELECT e.*, p.nom, p.prenom
     FROM entraineur e
     JOIN personne p ON e.id_entraineur= p.id
    ")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Responsable</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="accueil.css">
  <style>
   
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f8fc;
    }


    .logo {
      width: 130px;
      height: auto;
    }

    main {
      padding: 2rem;
    }

    main .h3 {
        text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 1rem;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #006699;
      color: white;
    }

    td a {
      text-decoration: none;
      color: #006699;
      font-weight: bold;
    }

    td a:hover {
      color: #003f5c;
    }

   
  </style>
  </head>
  <body>
    <!-- navbar -->
<header>
  <nav class="navbar">
    <img src="Logo-SailWind.png" alt="Logo SailWind" class="logo">
    <ul class="nav-links">
      <li><a href="espace_responsable.php">Accueil</a></li>
      
      <li><a href="logout.php">Se déconnecter</a></li>
    </ul>
  </nav>
</header>

<!-- Maincontent -->
<main>
  <h3 style="text-align: center;">📋 Liste des entraîneurs</h3>
<br>
  <table >
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Degré</th>
      <th>Expérience</th>
      <th>Niveau</th>
      <th>Actions</th>
    </tr>

    <?php foreach ($entraineurs as $e): ?>
    <tr>
      <td><?= $e['id_entraineur'] ?></td>
      <td><?= htmlspecialchars($e['nom']) ?></td>
      <td><?= htmlspecialchars($e['prenom']) ?></td>
      <td><?= htmlspecialchars($e['degre']) ?></td>
      <td><?= htmlspecialchars($e['experience']) ?></td>
      <td><?= htmlspecialchars($e['niveau_encadrement']) ?></td>
      <td>
        <a href="modifier_entraineur.php?id=<?= $e['id_entraineur'] ?>">✏️ Modifier</a> |
        <a href="supprimer_entraineur.php?id=<?= $e['id_entraineur'] ?>" onclick="return confirm('Supprimer cet entraîneur ?')">❌ Supprimer</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</main>

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
    <p>Pour les paiements, veuillez contacter le : <br>+213 123 456 789</p>
  </div>
</footer>

  </body>
  </html>
