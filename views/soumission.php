<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soumission Cahier de Charge</title>

    <link rel="stylesheet" href="../views/style.css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

</head>
<body>
<div class="auth-container">
    <h2>Soumission du Cahier de Charge</h2>
    <form action="/tp_php/public/submit" method="post">
        <input type="text" name="theme" placeholder="Intitulé du thème" required>

        <!-- Champ binôme avec id pour le JS -->
        <input type="text" id="binome" name="binome" placeholder="Nom du binôme" required>

        <select id="filiere" name="filiere" required>
            <option value="al">AL</option>
            <option value="si">SI</option>
            <option value="src">SRC</option>
        </select>
        <button type="submit">Soumettre</button>
    </form>
    <p>Connecté en tant qu’étudiant</p>

    <?php
    session_start();
    $etudiantId = $_SESSION['etudiant_id'] ?? null;

    if ($etudiantId === null) {
        echo "Utilisateur non connecté.";
    } else {
        $info = Projet::getBinomeAndEncadreur($etudiantId);

        if ($info) {
            echo "Vous êtes le binôme <strong>" . htmlspecialchars($info['nom1']) . "</strong> et <strong>" . htmlspecialchars($info['nom2']) . "</strong> et votre encadreur est Mr/Mme <strong>" . htmlspecialchars($info['encadreur_nom'] ?? 'Non attribué') . "</strong>.";
        } else {
            echo "Aucun projet ou binôme trouvé pour vous.";
        }
    }
    ?>
</div>


    <script>
    $(function() {
        $("#binome").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/tp_php/public/api/search_binome.php",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function() {
                        response([]);
                    }
                });
            },
            minLength: 2,
            delay: 300 
        });
    });
    </script>
</body>
</html>
