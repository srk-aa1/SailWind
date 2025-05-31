<?php
include("connexion.php");

$id = $_GET['id'];
$stmt = $bdd->prepare("
    SELECT e.*, p.nom, p.prenom 
    FROM entraineur e 
    JOIN personne p ON e.id_entraineur = p.id 
    WHERE e.id_entraineur = ?
");
$stmt->execute([$id]);
$entraineur = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Responsable</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="accueil.css">
  <style>
      
    

    form {
      max-width: 600px;
      margin: 0 auto;
      padding: 2rem;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }

    input[type="text"] {
      width: 100%;
      padding: 0.7rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-top: 0.3rem;
    }

    button {
      margin-top: 2rem;
      background-color: #0077b6;
      color: white;
      border: none;
      padding: 0.8rem 1.5rem;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #023e8a;
    }
@media (max-width: 768px) {
      .nav-links {
        flex-direction: column;
        gap: 0.5rem;
      }
    }
      form {
        margin: 1rem;
      }

  </style>
   </head>
  <body>


  <!-- Formulaire -->
  <h3 style="text-align: center;">Modifier un entraîneur</h3><br>
  <form action="update_entraineur.php" method="POST" style="margin: auto;">
    <input type="hidden" name="id_entraineur" value="<?= $entraineur['id_entraineur'] ?>">

    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($entraineur['nom']) ?>" required>

    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($entraineur['prenom']) ?>" required>

    <label>Degré :</label>
    <input type="text" name="degre" value="<?= htmlspecialchars($entraineur['degre']) ?>" required>

    <label>Expérience :</label>
    <input type="text" name="experience" value="<?= htmlspecialchars($entraineur['experience']) ?>" required>

    <label>Niveau d'encadrement :</label>
    <input type="text" name="niveau_encadrement" value="<?= htmlspecialchars($entraineur['niveau_encadrement']) ?>" required>

    <button type="submit">✅ Mettre à jour</button>
  </form>
  <br>

  </body>
  </html>


	
