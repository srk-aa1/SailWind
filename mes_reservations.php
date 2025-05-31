<?php
session_start();

if (!isset($_SESSION['id_membre'])) {
    header("Location: login.php");
    exit();
}

include("connexion.php");

$id_membre = $_SESSION['id_membre'];

// Récupérer les réservations du membre (avec activités et sessions)
$sql = "
    SELECT
        r.id_reserv,
        a.nom AS nom_activite,
        s.date,
        s.heure_debut,
        s.heure_fin,
        r.statut
    FROM reservation r
    JOIN session s ON r.id_sess = s.id_sess
    JOIN activite a ON s.id_act = a.id_act
    WHERE r.id_membre = ?
    ORDER BY s.date DESC, s.heure_debut DESC
";

$stmt = $bdd->prepare($sql);
$stmt->execute([$id_membre]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Mes réservations</title>
    <link rel="stylesheet" href="accueil.css">
    
    <style>
        h2 {
            text-align: center;
            margin: 30px 0;
            color: #023e8a;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        .message {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #0077b6;
            color: white;
        }

        .statut {
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            display: inline-block;
        }

        .statut-en-attente {
            background-color: #fff3cd;
            color: #856404;
        }

        .statut-accepte {
            background-color: #d4edda;
            color: #155724;
        }

        .statut-refuse {
            background-color: #f8d7da;
            color: #721c24;
        }

        form {
            display: inline;
        }

        button {
            background-color: #e63946;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
        }

        .no-reservation {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #555;
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
<br>
<h2>Mes réservations</h2>

<div class="container">
     <?php if (isset($_GET['msg'])): ?>
        <div class="message"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <?php if (count($reservations) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Activité</th>
                    <th>Date</th>
                    <th>Heure début</th>
                    <th>Heure fin</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
        <tbody>
            <?php foreach ($reservations as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['nom_activite']) ?></td>
                <td><?= htmlspecialchars($row['date']) ?></td>
                <td><?= htmlspecialchars($row['heure_debut']) ?></td>
                <td><?= htmlspecialchars($row['heure_fin']) ?></td>
            <td>
                <?php
                    $statut = $row['statut'];
                    $class = '';
                    if ($statut === 'en attente') $class = 'statut-en-attente';
                    elseif ($statut === 'accepte') $class = 'statut-accepte';
                    elseif ($statut === 'refuse') $class = 'statut-refuse';
                ?>
                <span class="statut <?= $class ?>"><?= htmlspecialchars($statut) ?></span>
            </td>
            <td>
                <?php if ($statut === 'en attente' || $statut === 'accepte'): ?>
                <form method="POST" action="annuler_reservation.php" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');" style="margin:0;">
                    <input type="hidden" name="id_reserv" value="<?= $row['id_reserv'] ?>">
                    <button type="submit">Annuler</button>
                </form>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
     <div class="no-reservation">Vous n'avez aucune réservation pour le moment.</div>
<?php endif; ?>
</div>
<br><br><br>
    <br>
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

