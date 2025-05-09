<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Créer un compte</h2>
        <form method="post" action="/tp_php/public/register">
            <input type="text" name="name" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="password" name="password" placeholder="Mot de passe" required>

            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="/tp_php/public/">Connexion</a></p>
    </div>
</body>
</html>
