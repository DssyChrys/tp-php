<?php

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Connexion</h2>
        <form action="/tp_php/public/loginpost" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
            <p>Pas encore inscrit ? <a href="/tp_php/public/inscription">Créer un compte</a></p>
        </form>
    </div>
</body>
</html>