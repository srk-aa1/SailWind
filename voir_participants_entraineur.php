<?php
include("connexion.php"); // connexion à la BDD
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'entraineur') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id']; // ID de la personne connectée
// Récupérer l'id_entraineur à partir de l'id_personne
$query_entraineur = $bdd->prepare("SELECT id_entraineur FROM entraineur WHERE id = ?");
$query_entraineur->execute([$id]);
$entraineur = $query_entraineur->fetch();
$id_entraineur = $entraineur['id_entraineur'];

// Récupérer les sessions encadrées
$query = $bdd->prepare("
    SELECT s.id_sess, s.date, s.heure_debut, s.heure_fin, a.nom AS nom_activite
    FROM session s
    JOIN encadrement e ON s.id_sess = e.id_sess
    JOIN activite a ON s.id_act = a.id_act
    WHERE e.id_entraineur = ?
    ORDER BY s.date
");
$query->execute([$id_entraineur]);
$sessions = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des participants</title>
    <link rel="stylesheet" href="accueil.css">
    <style>
          h2 {
            text-align: center;
            margin-top: 30px;
            color: #0077b6;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }

        .session-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 20px;
        }

        .session-card h3 {
            margin-top: 0;
            color: #023e8a;
        }

        .participant-list {
            list-style: none;
            padding-left: 0;
        }

        .participant-list li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .participant-list li:last-child {
            border-bottom: none;
        }

        .empty {
            font-style: italic;
            color: #888;
            padding: 10px 0;
        }
    </style>
</head>
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
  <br>

<h2>👥 Participants à mes séances</h2>

<div class="container">
<?php if (count($sessions) === 0): ?>
    <p class="empty">Aucune séance trouvée.</p>
<?php else: ?>
    <?php foreach ($sessions as $session): ?>
        <div class="session-card">
            <h3><?= htmlspecialchars($session['nom_activite']) ?> — <?= $session['date'] ?> (<?= $session['heure_debut'] ?> à <?= $session['heure_fin'] ?>)</h3>

            <?php
            // Participants confirmés pour cette session
            $stmt_participants = $bdd->prepare("
                SELECT p.nom, p.prenom, p.email, p.telephone
                FROM reservation r
                JOIN membre m ON r.id_membre = m.id_membre
                JOIN personne p ON m.id = p.id
                WHERE r.id_sess = ? AND r.statut = 'Confirmée'
            ");
            $stmt_participants->execute([$session['id_sess']]);
            $participants = $stmt_participants->fetchAll();
            ?>

            <?php if (count($participants) > 0): ?>
                <ul class="participant-list">
                    <?php foreach ($participants as $p): ?>
                        <li><strong><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></strong> — 📧 <?= $p['email'] ?> — 📞 <?= $p['telephone'] ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="empty">Aucun participant confirmé.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
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