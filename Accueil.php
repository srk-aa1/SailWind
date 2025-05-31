<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SailWind - Accueil</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="accueil.css">
  
</head>
<body>
  <!-- Navbar -->
  <header>
    <nav class="navbar">
      <img src="Logo-SailWind.png" alt="Logo" class="logo">

      <ul class="nav-links">
        <li><a href="Accueil.php">Accueil</a></li>
        <li class="dropdown">
          <a href="#">Events ▾</a>
          <ul class="dropdown-content">
            <li><a href="#" > "Bientot disponible" </a></li>
          </ul>
        </li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact_navbar.php">Contact</a></li>
      </ul>
    </nav>
  </header>

  <!-- Section principale -->
  <section class="hero">
    <h1>
      Nous avons la même passion : 
    </h1>
    <h2> la mer </h2>
    <video controls class="intro-video">
      <source src="assets/presentation.mp4" type="video/mp4">
    </video>
  </section>

  <!-- Qui nous sommes -->
  <section class="split-section">
    <div class="left">
      <h2>Qui nous sommes ?</h2>
      <p>SailWind est un club de voile dédié aux passionnés de la mer. Nous proposons des activités encadrées pour débutants et confirmés.</p>
    </div>
    <div class="right">
      <h2>Objectifs du club</h2>
      <p>Former, encadrer, et promouvoir les sports nautiques au sein de notre communauté.</p>
    </div>
  </section>

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
