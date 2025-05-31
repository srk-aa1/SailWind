
<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'entraineur') {
    header("Location: login.php");
    exit();
}

require_once "connexion.php";

// Récupérer l’ID de l’entraîneur connecté
$id = $_SESSION['id'];

// Récupérer son id_entraineur à partir de id_personne
$requete_id = $bdd->prepare("SELECT id_entraineur FROM entraineur WHERE id = ?");
$requete_id->execute([$id]);
$entraineur = $requete_id->fetch();

if (!$entraineur) {
    $id_entraineur = null;
    $seances = [];
} else {
    $id_entraineur = $entraineur['id_entraineur'];

    $sql = "
        SELECT s.id_sess, s.date, s.heure_debut, s.heure_fin, s.categorie_sess, s.remarque,
               a.nom AS nom,
               l.adresse AS lieu
        FROM encadrement e
        JOIN session s ON e.id_sess = s.id_sess
        JOIN activite a ON s.id_act = a.id_act
        LEFT JOIN se_deroule sd ON s.id_sess = sd.id_sess
        LEFT JOIN lieu l ON sd.id_lieu = l.id_lieu
        WHERE e.id_entraineur = ?
        ORDER BY s.date DESC
    ";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_entraineur]);
    $seances = $stmt->fetchAll();
}



// Requête pour récupérer les séances encadrées
$sql = "
    SELECT s.id_sess, s.date, s.heure_debut, s.heure_fin, s.remarque, s.categorie_sess,
           a.nom AS nom_activite,
           l.adresse AS lieu
    FROM encadrement e
    JOIN session s ON e.id_sess = s.id_sess
    JOIN activite a ON s.id_act = a.id_act
    LEFT JOIN se_deroule sd ON s.id_sess = sd.id_sess
    LEFT JOIN lieu l ON sd.id_lieu = l.id_lieu
    WHERE e.id_entraineur = ?
    ORDER BY s.date DESC
";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id_entraineur]);
$seances = $stmt->fetchAll();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes séances</title>
  <link rel="stylesheet" href="accueil.css">
</head>
<style>
     h2 {
      text-align: center;
      margin: 30px 0 10px;
    }

    .container {
      max-width: 1100px;
      margin: auto;
      padding: 20px;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    h3 {
      margin-top: 0;
      color:rgb(255, 255, 255);
    }

    p {
      margin: 8px 0;
      color:rgb(255, 255, 255);
    }

    p .color{
      color: #161D6F;
    }
    .btn {
      background-color: #e63946;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
      transition: background-color 0.2s;
    }
     .btn:hover {
      background-color: #c82333;
    }

    .empty-message {
      text-align: center;
      margin-top: 40px;
      font-style: italic;
      color: #666;
    }
</style>
<body>
   <!-- Navbar -->
  <header>
    <nav class="navbar">
      <img src="Logo-SailWind.png" alt="Logo" class="logo">
      <ul class="nav-links">
        <li><a href="espace_entraineur.php">Accueil</a></li>
        
        <li><a href="consulter_activites.entraineur.php">Mes séances</a></li>
        <li><a href="voir_participants_entraineur.php">Participants</a></li>
        
      <li><a href="logout.php">Se déconnecter</a></li>

      </ul>
    </nav>
  </header>
  
  <div class="container">
    <h2>📋 Mes séances encadrées</h2>

    <?php if (empty($seances)) : ?>
        <div class="empty-message">Aucune séance encadrée pour le moment.</div>
  <?php else: ?>
      <div class="card-grid">
        <?php foreach ($seances as $s) : ?>
          <div class="card">
          <h3 style="color:#161D6F"><?= htmlspecialchars($s['nom_activite']) ?></h3>
          <p style="color:#0B2F9F"><strong>Date :</strong> <?= htmlspecialchars($s['date']) ?></p>
          <p style="color:#0B2F9F"><strong>Heure :</strong> <?= htmlspecialchars($s['heure_debut']) ?> - <?= htmlspecialchars($s['heure_fin']) ?></p>
          <p style="color:#0B2F9F"><strong>Lieu :</strong> <?= htmlspecialchars($s['lieu']) ?: 'Non spécifié' ?></p>
          <form action="annuler_seance.php" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette séance ?');">
            <input type="hidden" name="id_sess" value="<?= $s['id_sess'] ?>">
            <button type="submit" class="btn">Annuler</button>
          </form>
        </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div><br><br>

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

