<?php 
include("connexion.php");
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Responsable</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="accueil.css">
<style>
    table {
    border-collapse: collapse;
    width: 80%;
    margin-top: 20px;
    margin: auto;
    font-family: Arial, sans-serif;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ccc;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f0f0f0;
    color: #333;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

button {
    padding: 6px 10px;
    margin: 2px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[name="action"][value="valider"] {
    background-color: #4CAF50;
    color: white;
}

button[name="action"][value="refuser"] {
    background-color: #ff9800;
    color: white;
}

button[name="action"][value="supprimer"] {
    background-color: #f44336;
    color: white;
}

h2 {
    font-family: 'Segoe UI', sans-serif;
    color: #2c3e50;
    margin-bottom: 10px;
    text-align: center;
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
  </header><br>
<?php

try {
    // Récupération des activités proposées en attente
    $stmt = $bdd->prepare("SELECT * FROM activite_proposee WHERE statut = 'en-attente'");
    $stmt->execute();
    $propositions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($propositions) === 0) {
        echo "<p>Aucune activité proposée pour le moment.</p>";
    } else {
        echo "<h2>Activités proposées à valider</h2>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Lien vidéo</th>
                <th>Niveau requis</th>
                <th>Actions</th>
              </tr>";

        foreach ($propositions as $prop) {
            echo "<tr>
                    <td>" . htmlspecialchars($prop['nom']) . "</td>
                    <td>" . htmlspecialchars($prop['description']) . "</td>
                    <td>" . htmlspecialchars($prop['prix']) . "</td>
                    <td>" . htmlspecialchars($prop['lien_video']) . "</td>
                    <td>" . htmlspecialchars($prop['niveau_requis']) . "</td>
                    <td>
                        <form action='traitement_activites_proposee_actions.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id_proposition' value='" . $prop['id_proposition'] . "'>
                            <button type='submit' name='action' value='valider'>✅ Valider</button> 
                            <button type='submit' name='action' value='refuser'>❌ Refuser</button>
                            <button type='submit' name='action' value='supprimer'>🗑️ Supprimer</button>
                    
                        </form>
                      
                    </td>
                    
                  </tr>";
        }

        echo "</table>";
    }

} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
?><br><br>
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