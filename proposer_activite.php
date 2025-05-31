<?php
session_start();
include("connexion.php");

// Vérifie que l'entraineur est connecté
if (!isset($_SESSION['id_entraineur'])) {
    echo "<p style='color:red;'>❌ Erreur : vous devez être connecté comme entraineur.</p>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $prix = isset($_POST['prix']) && $_POST['prix'] !== '' ? $_POST['prix'] : null;
    $lien_video = isset($_POST['lien_video']) && $_POST['lien_video'] !== '' ? trim($_POST['lien_video']) : null;
    $niveau = isset($_POST['niveau']) ? trim($_POST['niveau']) : '';
    $id_entraineur = $_SESSION['id_entraineur'];

    if ($nom === '' || $description === '' || $niveau === '') {
        echo "<p style='color:red;'>❌ Tous les champs obligatoires doivent être remplis.</p>";
    } else {
        try {
            $stmt = $bdd->prepare("
                INSERT INTO activite_proposee (nom, description, prix, lien_video, niveau_requis, id_entraineur)
                VALUES (:nom, :description, :prix, :lien_video, :niveau, :id_entraineur)
            ");

            $stmt->execute([
                ':nom' => $nom,
                ':description' => $description,
                ':prix' => $prix,
                ':lien_video' => $lien_video,
                ':niveau' => $niveau,
                ':id_entraineur' => $id_entraineur
            ]);

            echo "<p style='color:green;'>✅ Proposition envoyée avec succès !</p>";
        } catch (PDOException $e) {
            echo "<p style='color:red;'>❌ Erreur : " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Proposer une activité</title>
        <link rel="stylesheet" href="accueil.css">
   <style>
    
 h2 {
            text-align: center;
            color: #004080;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #0077cc;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #005fa3;
        }

        .success {
            text-align: center;
            color: green;
            margin-top: 20px;
        }

        .error {
            text-align: center;
            color: red;
            margin-top: 20px;
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
  </header><br>
<h2>Proposer une nouvelle activité</h2>

<form method="POST" action="proposer_activite.php">
    <input type="hidden" name="id_entraineur" value="<?php echo $_SESSION['id_entraineur']; ?>">
    <label for="nom">Nom de l'activité :</label>
    <input type="text" name="nom" required>

    <label for="description">Description :</label>
    <textarea name="description" required></textarea>

    <label for="prix">Prix (DA) :</label>
    <input type="number" name="prix"  required>

    <label for="lien_video">Lien vers une vidéo (optionnel) :</label>
    <input type="text" name="lien_video">

    <label for="niveau_requis">Niveau requis :</label>
    <select name="niveau" required>
        <option value="">-- Choisir un niveau --</option>
        <option value="débutant">Débutant</option>
        <option value="intermédiaire">Intermédiaire</option>
        <option value="avancé">Avancé</option>
    </select>

    <button type="submit">Ajouter l'activité</button>
</form>
<?php if (!empty($message)): ?>
    <div class="message"><?= $message ?></div>
<?php endif; ?>
<br><br>

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