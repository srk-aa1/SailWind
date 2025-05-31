<?php
include("connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les inscriptions</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="accueil.css">
    <style>
      
a {
    text-decoration: none;
    color: inherit;
}



/*------------------ content-----------------*/
         h2 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .message {
            text-align: center;
            background-color: #e0f7da;
            color: #2e7d32;
            padding: 10px 20px;
            border-radius: 8px;
            width: fit-content;
            margin: 20px auto;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
            margin: auto;
        }

        th, td {
            padding: 15px 20px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #007BFF;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .accept, .reject {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .accept {
            background-color: #28a745;
            color: white;
        }

        .accept:hover {
            background-color: #218838;
        }

        .reject {
            background-color: #dc3545;
            color: white;
        }

        .reject:hover {
            background-color: #c82333;
        }

        p {
            text-align: center;
            font-size: 18px;
            
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

<h2>📋 Gérer les inscriptions aux sessions</h2>

<?php
if (isset($_GET['msg'])) {
    echo "<p class='message'>" . htmlspecialchars($_GET['msg']) . "</p>";
}

// Requête SQL pour récupérer les réservations en attente
$sql = "
    SELECT
        r.id_reserv,
        p.nom AS nom_personne,
        p.prenom AS prenom_personne,
        a.nom AS nom_activite,
        s.date,
        s.heure_debut,
        s.heure_fin
    FROM reservation r
    JOIN membre m ON r.id_membre = m.id_membre
    JOIN personne p ON m.id = p.id
    JOIN session s ON r.id_sess = s.id_sess
    JOIN activite a ON s.id_act = a.id_act
    WHERE r.statut = 'en attente'
    ORDER BY s.date, s.heure_debut
";

$stmt = $bdd->query($sql);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($reservations) > 0):
?>

<table>
    <thead>
        <tr>
            <th>Membre</th>
            <th>Activité</th>
            <th>Date</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($reservations as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['prenom_personne'] . ' ' . $row['nom_personne']) ?></td>
            <td><?= htmlspecialchars($row['nom_activite']) ?></td>
            <td><?= htmlspecialchars($row['date']) ?></td>
            <td><?= htmlspecialchars($row['heure_debut']) ?></td>
            <td><?= htmlspecialchars($row['heure_fin']) ?></td>
            <td>
                <form method="POST" action="action_inscription.php" style="display:inline;">
                    <input type="hidden" name="id_reserv" value="<?= $row['id_reserv'] ?>">
                    <button type="submit" name="action" value="accepter" class="accept">✅ Accepter</button>
                    <button type="submit" name="action" value="refuser" class="reject" onclick="return confirm('Êtes-vous sûr de vouloir refuser cette inscription ?');">❌ Refuser</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p>Aucune réservation en attente.</p>
<?php endif; ?>
<br><br><br><br><br><br>

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

