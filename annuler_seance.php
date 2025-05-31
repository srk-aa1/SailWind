<?php
session_start();
include("connexion.php");

// Vérifier si l'utilisateur est connecté et est entraîneur
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'entraineur') {
    header("Location: login.php");
    exit();
}

// Récupérer les séances encadrées par l'entraîneur
$id_entraineur = $_SESSION['id'];
$stmt = $bdd->prepare("
    SELECT s.id_sess, a.nom_act, s.date, s.heure_debut, s.heure_fin, s.remarque
    FROM session s
    JOIN activite a ON s.id_act = a.id_act
    JOIN encadrement e ON s.id_sess = e.id_sess
    WHERE e.id_entraineur = ?
");
$stmt->execute([$id_entraineur]);
$sessions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Annuler une Séance</title>
  <style>
    .btn-annuler {
        background-color: #d9534f;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-annuler:hover {
        background-color: #c9302c;
    }

    .confirmation-popup {
        display: none;
        position: fixed;
        background: white;
        padding: 20px;
        border: 1px solid #ccc;
        top: 30%;
        left: 35%;
        z-index: 10;
        box-shadow: 0 0 10px #999;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 5;
    }
  </style>
</head>
<body>
  <?php include("navbar.php"); ?>
  <div class="container">
    <h1>Annuler une Séance</h1>

    <table class="sessions-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Activité</th>
          <th>Date</th>
          <th>Heure</th>
          <th>Statut</th>
          <th>Annuler</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($sessions as $i => $s): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($s['nom_activite']) ?></td>
          <td><?= htmlspecialchars($s['date']) ?></td>
          <td><?= htmlspecialchars($s['heure_debut']) . " - " . htmlspecialchars($s['heure_fin']) ?></td>
          <td><?= htmlspecialchars($s['remarque']) ?></td>
          <td>
            <?php if ($s['remarque'] !== 'annulée'): ?>
              <button class="btn-annuler" onclick="confirmAnnulation(<?= $s['id_sess'] ?>)">Annuler</button>
            <?php else: ?>
              ❌
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Overlay & Pop-up -->
  <div class="overlay" id="overlay"></div>
  <div class="confirmation-popup" id="popup">
    <h3>Êtes-vous sûr de vouloir annuler cette séance ?</h3>
    <button id="btnConfirmer">Oui, annuler</button>
    <button onclick="fermerPopup()">Non</button>
  </div>

  <script>
    let sessionId = null;

    function confirmAnnulation(id) {
      sessionId = id;
      document.getElementById('overlay').style.display = "block";
      document.getElementById('popup').style.display = "block";
    }

    function fermerPopup() {
      sessionId = null;
      document.getElementById('overlay').style.display = "none";
      document.getElementById('popup').style.display = "none";
    }

    document.getElementById('btnConfirmer').addEventListener('click', function() {
      if (sessionId) {
        window.location.href = "traiter_annulation.php?id_session=" + sessionId;
      }
    });
  </script>
</body>
</html>
