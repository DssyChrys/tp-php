<?php
require_once __DIR__ . '/../models/enseignant.php';

// Traitement du formulaire d'ajout
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $domaines = $_POST['domaines'] ?? [];

    if ($nom === '') {
        $message = "Veuillez saisir le nom de l'enseignant.";
    } elseif (!is_array($domaines) || count($domaines) === 0) {
        $message = "Veuillez sélectionner au moins un domaine d'expertise.";
    } else {
        $domaines_json = json_encode($domaines);
        $success = Enseignant::ajouter($nom, $domaines_json);
        if ($success) {
            $message = "Enseignant ajouté avec succès.";
        } else {
            $message = "Erreur lors de l'ajout.";
        }
    }
}

// Récupérer tous les enseignants
$enseignants = Enseignant::getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestion des enseignants</title>

    <link rel="stylesheet" href="../views/style.css" />
    <style>
        body {
            margin: 0;
            background: #eaf7f1;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .page-container {
            display: flex;
            gap: 30px;
            width: 95%;
            max-width: 1200px;
            align-items: flex-start;
        }

        .auth-container {
            background: #ffffff;
            padding: 35px 28px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
            width: 420px;
            text-align: center;
            flex-shrink: 0;
        }

        .affectation-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.05);
            flex-grow: 1;
            min-width: 0;
        }

        .auth-container h2,
        .affectation-container h2 {
            color: #2d5c4d;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .message {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        input[type="text"], button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #d0e4dc;
            border-radius: 12px;
            background: #f9fdfb;
            font-size: 1rem;
            transition: 0.3s;
        }

        input[type="text"]:focus {
            border-color: #79c2a6;
            background: #ffffff;
            outline: none;
        }

        button {
            background: #79c2a6;
            border: none;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #5cae91;
        }

        fieldset {
            text-align: left;
            margin-top: 15px;
            border: none;
            padding: 0;
        }

        legend {
            font-weight: 600;
            color: #2d5c4d;
            margin-bottom: 8px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            cursor: pointer;
            font-size: 1rem;
            color: #444;
        }

        input[type="checkbox"] {
            margin-right: 8px;
            transform: scale(1.1);
            vertical-align: middle;
            cursor: pointer;
        }

        /* Table styles */
        .affectation-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .affectation-container th,
        .affectation-container td {
            border: 1px solid #dbe8e3;
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }

        .affectation-container th {
            background-color: #79c2a6;
            color: white;
        }

        .affectation-container tr:nth-child(even) {
            background-color: #f5fbf8;
        }
    </style>
</head>
<body>
    <div class="page-container">

        <div class="auth-container">
            <h2>Ajouter un enseignant</h2>

            <?php if ($message): ?>
                <p class="message <?= strpos($message, 'Erreur') === false ? 'success' : 'error' ?>">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>

            <form method="post" action="">
                <input type="text" name="nom" placeholder="Nom de l'enseignant" required />

                <fieldset>
                    <legend>Domaines d'expertise :</legend>

                    <label><input type="checkbox" name="domaines[]" value="AL" /> AL</label>
                    <label><input type="checkbox" name="domaines[]" value="SI" /> SI</label>
                    <label><input type="checkbox" name="domaines[]" value="SRC" /> SRC</label>
                </fieldset>

                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div class="affectation-container">
            <h2>Liste des enseignants</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Domaines</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($enseignants) === 0): ?>
                        <tr><td colspan="2">Aucun enseignant enregistré.</td></tr>
                    <?php else: ?>
                        <?php foreach ($enseignants as $ens): ?>
                            <tr>
                                <td><?= htmlspecialchars($ens['nom']) ?></td>
                                <td>
                                    <?php
                                        $domaines = json_decode($ens['domaines'], true);
                                        if (is_array($domaines)) {
                                            echo htmlspecialchars(implode(', ', $domaines));
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
