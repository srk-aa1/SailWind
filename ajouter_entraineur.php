<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un entraîneur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="accueil.css"></style>
<style>

        .form-container {
            background-color: white;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 500px;

            width: 100%;
            margin-left: 32%;
            
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
       
        label {
            display: block;
            margin-bottom: 6px;
            color: #444;
            font-weight: 500;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message, .error-message {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 8px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>


<div class="form-container">
    <h3>👨‍🏫 Ajouter un entraîneur</h3>

    <?php if (isset($_GET['msg'])): ?>
        <div class="<?= strpos($_GET['msg'], 'succès') !== false ? 'success-message' : 'error-message' ?>">
            <?= htmlspecialchars($_GET['msg']) ?>
        </div>
    <?php endif; ?>

    <form action="inserer_entraineur.php" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" required>

        <label>Degré :</label>
        <input type="text" name="degre" required>

        <label>Expérience :</label>
        <input type="text" name="experience" required>

        <label>Niveau d'encadrement :</label>
        <input type="text" name="niveau_encadrement" required>

        <button type="submit">➕ Ajouter l'entraîneur</button>
    </form>
</div>

</body>
</html>