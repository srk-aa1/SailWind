<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="accueil.css">
    <style>
        body.contact-page {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f3f4f6;
    font-family: Arial, sans-serif;
}

.contact-container {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    max-width: 500px;
    width: 100%;
}

.contact-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.contact-header h1 {
    color: #1e3a8a;
    font-size: 1.5rem;
    font-weight: bold;
}

.contact-form .form-group {
    margin-bottom: 1rem;
}

.contact-form label {
    display: block;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 1rem;
    outline: none;
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.3);
}

.form-submit {
    margin-top: 1.5rem;
}

.form-submit button {
    width: 100%;
    background-color: #2563eb;
    color: white;
    padding: 0.75rem;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}

.form-submit button:hover {
    background-color: #1d4ed8;
}


    </style>
</head>

<body class="contact-page">
   
    <div class="contact-container">
        <div class="contact-header">
            <h1>ÉCRIVEZ-NOUS</h1>
        </div>
        <form class="contact-form">
            <div class="form-group">
                <label for="name">Nom/Prénom</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="form-submit">
                <button type="submit">ENVOYER</button>
            </div>
        </form>
    </div>

</body>
</html>

