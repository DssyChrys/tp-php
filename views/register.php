<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Créer un compte</h2>
        <form action="#" method="post">
            <input type="text" name="name" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="password" name="password" placeholder="Mot de passe" required>

            <!-- Rôle -->
            <select name="role" id="role" required>
                <option value="" disabled selected>Choisissez votre rôle</option>
                <option value="etudiant">Étudiant</option>
                <option value="enseignant">Enseignant</option>
                <option value="admin">Administrateur</option>
            </select>

            <!-- Domaine (affiché uniquement si Enseignant est choisi) -->
            <div id="domaine-container" style="display: none;">
                <select name="domaine" id="domaine">
                    <option value="" disabled selected>Choisissez votre domaine</option>
                    <option value="AL">AL</option>
                    <option value="SI">SI</option>
                    <option value="SRC">SRC</option>
                    <option value="ALSI">ALSI</option>
                    <option value="ALSRC">ALSRC</option>
                    <option value="SISRC">SISRC</option>
                </select>
            </div>

            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="login.html">Connexion</a></p>
    </div>

    <script>
        const roleSelect = document.getElementById("role");
        const domaineContainer = document.getElementById("domaine-container");
        const domaineSelect = document.getElementById("domaine");

        roleSelect.addEventListener("change", () => {
            if (roleSelect.value === "enseignant") {
                domaineContainer.style.display = "block";
                domaineSelect.setAttribute("required", "required");
            } else {
                domaineContainer.style.display = "none";
                domaineSelect.removeAttribute("required");
            }
        });
    </script>
</body>
</html>
