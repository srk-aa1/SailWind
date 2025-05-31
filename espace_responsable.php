<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}  

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'responsable') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Responsable</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="accueil.css">
  
    <style>
a {
    text-decoration: none;
    color: inherit;
}


/*---------- CONTENT ---------*/
    .espace-respo-page {
    font-family: Arial, sans-serif;
    background-color: #f3f4f6;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}


.respo-main {
    text-align: center;
    padding: 40px 20px;
}

.respo-main h2 {
    font-size: 1.8rem;
    color: #1e3a8a;
    margin-bottom: 10px;
}

.respo-main p {
    font-size: 1rem;
    color: #374151;
    margin-bottom: 30px;
    margin-left: 5%;
    text-align: left;
}

.respo-actions-grid {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 0 40px;
    margin: 40px auto;
    max-width: 1000px;
}

.btn-respo {
    background-color: #f9fafb;
    border: 2px solid #2563eb;
    color: #1e3a8a;
    border-radius: 10px;
    padding: 30px 20px;
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-respo:hover {
    background-color: #e0e7ff;
    border-color: #1d4ed8;
    transform: translateY(-3px);
}


/* TABLETTE : */
@media (max-width: 900px) {
    .respo-actions-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* MOBILE :  */
@media (max-width: 600px) {
    .respo-actions-grid {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>
<body class="espace-respo-page">
    <!-- Navbar -->
  <header>
    <nav class="navbar">
      <img src="Logo-SailWind.png" alt="Logo" class="logo">
      <!--<div class="logo">SailWind</div>-->
      <ul class="nav-links">
        <li><a href="espace_responsable.php">Accueil</a></li>
    
      <li><a href="logout.php">Se déconnecter</a></li>

      </ul>
    </nav>
  </header>


    <main class="respo-main">
        <h2>Bienvenue <?php echo htmlspecialchars($_SESSION['prenom']); ?> !</h2>
        <p>Ceci est votre espace administrateur.</p>

        <div class="respo-actions-grid">
            <a href="liste_membres.php" class="btn-respo">👤 Gérer les membres</a>
            <a href="consulter_propositions.php" class="btn-respo">🗂 Gestion des activités</a>
            <a href="gerer_inscriptions.php" class="btn-respo">📝 Gérer les inscriptions</a>
            <a href="ajouter_entraineur.php" class="btn-respo">➕ Ajouter un entraîneur</a>
            <a href="liste_entraineurs.php" class="btn-respo">📋 Liste des entraîneurs</a>
        </div>
    </main>
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


