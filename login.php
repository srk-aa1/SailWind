<?php
session_start();
include("connexion.php");
// Vérifie si le formulaire a été soumis via méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupère et nettoie l'email envoyé depuis le formulaire
    $email = trim($_POST['email']);
  // Récupère et nettoie l'email envoyé depuis le formulaire
    $motdepasse = $_POST['motdepasse'];
  //requête SQL pour récupérer les infos de l'utilisateur à partir de l'email
    $stmt = $bdd->prepare("SELECT * FROM personne WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
  // Vérifie si l'utilisateur existe et que le mot de passe correspond
    if ($user && $motdepasse === $user['mot_de_passe']) { 
       // Enregistre les informations dans la session
        $_SESSION['id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        // Si l'utilisateur est un membre, récupérer son id_membre
        if ($user['role'] === 'membre') {
            $stmtMembre = $bdd->prepare("SELECT id_membre FROM membre WHERE id = ?");
            $stmtMembre->execute([$user['id']]);
            $id_membre = $stmtMembre->fetchColumn();
            if($id_membre){
                $_SESSION['id_membre'] = $id_membre;
            }
        }
        // Si le rôle est entraineur,on recupère l'id entraineur
       if ($user['role'] === 'entraineur') {
        $stmtEntraineur = $bdd->prepare("SELECT id_entraineur FROM entraineur WHERE id = ?");
    $stmtEntraineur->execute([$user['id']]);
    $id_entraineur = $stmtEntraineur->fetchColumn();
    if ($id_entraineur) {
        $_SESSION['id_entraineur'] = $id_entraineur; 
    }
}
        // Redirection selon rôle
        switch ($user['role']) {
            case 'membre':
                header("Location: espace_membre.php");
                break;
            case 'entraineur':
                header("Location: espace_entraineur.php");
                break;
            case 'responsable':
                header("Location: espace_responsable.php");
                break;
            default:
                header("Location: accueil.php");
        }
        exit();// Termine l'exécution après la redirection
    } else {
      // Message d'erreur si l'identification échoue
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="accueil.css">
    <title>Login Form</title>
    <style>

.login-container {
  max-width: 400px;
  margin: 100px auto;
  padding: 30px 40px;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 16px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
  backdrop-filter: blur(8px);
  text-align: center;
  animation: fadeIn 0.8s ease-in-out;
}

.login-container h2 {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  color: #161D6F;
  margin-bottom: 20px;
}

.input-group {
  margin-bottom: 20px;
  text-align: left;
}

.input-group label {
  display: block;
  margin-bottom: 6px;
  color: #0B2F9F;
  font-weight: 600;
}

.input-field {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 10px;
  font-size: 15px;
  transition: 0.3s;
}

.input-field:focus {
  border-color: #98DED9;
  outline: none;
  box-shadow: 0 0 6px #98DED9;
}

.checkbox-group {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  font-size: 14px;
  color: #444;
}

.checkbox {
  margin-right: 10px;
}

.login-button {
  width: 100%;
  padding: 12px;
  background: #0B2F9F;
  color: white;
  border: none;
  border-radius: 12px;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s ease;
}

.login-button:hover {
  background-color: #161D6F;
}


/* idee ta3 Animation d'entrée  */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
    </style>
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
            <li><a href="#" >"Bientot disponible"</a></li>
          </ul>
        </li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact_navbar.php">Contact</a></li>

      </ul>
    </nav>
  </header>

    <div class="login-container">
        <h2>Login</h2>
         <!-- Message d’erreur -->
        <?php if (isset($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>

<form method="POST" action="">
    <div class="input-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" class="input-field" required>
    </div>
    <div class="input-group">
        <label for="motdepasse">Mot de passe *</label>
        <input type="password" id="motdepasse" name="motdepasse" class="input-field" required>
    </div>
    <div class="checkbox-group">
        <input type="checkbox" id="remember" class="checkbox">
        <label for="remember" class="checkbox-label">Se souvenir de moi</label>
    </div>
    <button type="submit" class="login-button">Se connecter</button>
</form>


</div>
</body>
       
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
      <p>Pour les paiements, veuillez contacter le : +213 123 456 789</p>
    </div>
  </footer>
</html>