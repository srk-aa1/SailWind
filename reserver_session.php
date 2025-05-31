<?php
session_start();

if (!isset($_SESSION['id_membre'])) {
    header("Location: login.php");
    exit();
}

include("connexion.php");

$id_membre = $_SESSION["id_membre"] ?? null;

// Récupérer les sessions disponibles
$sql = "SELECT s.id_sess, s.date, s.heure_debut, s.heure_fin, a.nom AS nom_activite
        FROM session s
        JOIN activite a ON s.id_act = a.id_act";
$stmt = $bdd->query($sql);
$sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réserver une session</title>
     <link rel="stylesheet" href="accueil.css">
     <style>
.logout-btn {
            background-color: #e63946;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #023e8a;
            margin: 30px auto;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #0077b6;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #023e8a;
        }

        .message {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

     </style>
</head>

<body>
    <!-- Navbar -->
  <header>
    <nav class="navbar">
      <img src="Logo-SailWind.png" alt="Logo" class="logo">
      <ul class="nav-links">
        <li><a href="espace_membre.php">Accueil</a></li>
        
        <li><a href="mon_profil.php">Mon profil</a></li>
        
      <li><a href="logout.php">Se déconnecter</a></li>

      </ul>
    </nav>
  </header>
<br>

    <h2>Réserver une session</h2>
<div class="container">
    <?php if (isset($_GET['msg'])): ?>
        <p style="color: <?= $_GET['msg'] === 'deja_reservee' ? 'red' : 'green' ?>;">
            <?php
                switch ($_GET['msg']) {
                    case 'deja_reservee':
                        echo "⚠️ Vous avez déjà réservé cette session.";
                        break;
                    case 'reservation_effectuee':
                        echo "✅ Réservation effectuée avec succès !";
                        break;
                    case 'erreur':
                        echo "❌ Une erreur est survenue.";
                        break;
                }
            ?>
        </p>
    <?php endif; ?>

    <form action="traitement_reserver_session.php" method="POST">
        <label for="id_sess">Choisissez une session :</label>
        <select name="id_sess" id="id_sess" required>
            <?php foreach ($sessions as $session): ?>
                <option value="<?= $session['id_sess'] ?>">
                    <?= htmlspecialchars($session['nom_activite']) ?> -
                    <?= htmlspecialchars($session['date']) ?> de
                    <?= htmlspecialchars($session['heure_debut']) ?> à
                    <?= htmlspecialchars($session['heure_fin']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <input type="submit" value="Réserver">
    </form></div><br><br>
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

