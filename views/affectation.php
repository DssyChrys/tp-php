<?php
require_once __DIR__ . '/../models/projet.php';
require_once __DIR__ . '/../models/enseignant.php';

// Récupérer tous les projets
$projets = Projet::getAll();

// Récupérer tous les enseignants pour la liste déroulante
$enseignants = Enseignant::getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Affectation des encadreurs</title>
  <link rel="stylesheet" href="../views/style.css" />
  <style>
    .header-container {
      display: flex;
      align-items: center;
      justify-content: space-between; 
      margin-bottom: 20px;
    }

    .btn-encadreur a{
      padding: 8px 16px;
      background-color: #2d5c4d;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
    }

    .btn-encadreur:hover {
      background-color: rgb(36, 88, 72);
    }
  </style>
</head>
<body>
  <div class="affectation-container">
    <div class="header-container">
      <h2>Affectation des encadreurs</h2>
      <button class="btn-encadreur" type="button"><a href="/tp_php/public/liste">Encadreur</a></button>
    </div>

    <table>
      <thead>
        <tr>
          <th>Étudiant</th>
          <th>Binôme</th>
          <th>Thème</th>
          <th>Encadrant</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($projets)): ?>
          <tr>
            <td colspan="4">Aucun projet trouvé.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($projets as $projet): ?>
            <tr>
              <td><?= htmlspecialchars($projet['etudiant_nom']) ?></td>
              <td><?= htmlspecialchars($projet['binome_nom']) ?></td>
              <td><?= htmlspecialchars($projet['theme']) ?></td>
              <td>
                <form method="post" action="assign_encadreur.php" style="margin:0;">
                  <input type="hidden" name="projet_id" value="<?= (int)$projet['id'] ?>" />
                  <select name="enseignant_id" onchange="this.form.submit()">
                    <option value="">-- Choisir un enseignant --</option>
                    <?php foreach ($enseignants as $ens): ?>
                      <option value="<?= (int)$ens['id'] ?>" <?= ($projet['enseignant_id'] ?? null) == $ens['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ens['nom']) ?> (<?= htmlspecialchars($ens['domaines']) ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
