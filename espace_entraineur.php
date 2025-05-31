
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}  
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'entraineur') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Entraîneur</title>
    <link rel="stylesheet" href="accueil.css">

    <style>
.container {
  max-width: 1100px;
  margin: auto;
  padding: 40px 20px;
}

/* Titres */
h1, h2 {
  text-align: center;
  color:rgb(7, 93, 179);
}

/* Grille des cartes */
.card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-top: 40px;
}

/* Carte individuelle */
.card {
  background-color: #fff;
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  transition: transform 0.2s, box-shadow 0.2s;
  text-align: center;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}
/* Liens / boutons */
.btn {
  display: inline-block;
  margin-top: 15px;
  padding: 10px 18px;
  background-color: #007bff;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  transition: background-color 0.2s;
}

.btn:hover {
  background-color: #0056b3;
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
  
  <div class="container">
    <h2>Bienvenue Coach <?php echo htmlspecialchars($_SESSION['prenom']); ?> !</h2>
    <p>Ceci est votre espace entraîneur.</p>
    
    <div class="card-grid">
      <div class="card">
        <h2>Consulter mes séances encadrées</h2>
        <p>Voir toutes les activités que vous encadrez.</p>
        <a href="consulter_activites.entraineur.php" class="btn">Voir mes séances</a>
      </div>

      <div class="card">
        <h2>Voir la liste des Participants</h2>
        <p>Consultez les participants inscrits à vos séances.</p>
        <a href="voir_participants_entraineur.php"class="btn">Voir participants</a>
      </div>

      <div class="card">
        <h2>Proposer une nouvelle activité</h2>
        <p>Soumettez une nouvelle activité à organiser.</p>
        <a href="proposer_activite.php" class="btn">Aller au formulaire</a>
      </div>
    </div>
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