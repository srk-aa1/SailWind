
<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
} 

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'membre') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Membre</title>
    <link rel="stylesheet" href="accueil.css">
    <style>
          * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: #f4fefc;
    color: #161D6F;
    line-height: 1.6;
}
/* Contenu principal */
    .container {
      padding: 2rem;
      text-align: center;
    }

    h2 {
      color: #023e8a;
      margin-bottom: 30px;
    }

    .card-links {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .card-links a {
      padding: 15px;
      width: 220px;
      background-color: #0077b6;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-size: 18px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, background-color 0.3s ease;
    }

    .card-links a:hover {
      background-color: #023e8a;
      transform: translateY(-3px);
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

<div class="container">
    <h2>Bienvenue dans votre espace membre, <?= htmlspecialchars($_SESSION['prenom']) ?> !</h2>
    <div class="card-links">
      <a href="mon_profil.php">🧾 Mon profil</a>
      <a href="reserver_session.php">🛶 Réserver une session</a>
      <a href="mes_reservations.php">📅 Mes réservations</a>
    </div>
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