<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/projet.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projetId = (int)($_POST['projet_id'] ?? 0);
    $encadreurId = $_POST['enseignant_id'] !== '' ? (int)$_POST['enseignant_id'] : null;

    if ($projetId > 0) {
        Projet::assignEncadreur($projetId, $encadreurId);
    }

    header('Location: /tp_php/public/affectation');
    exit();
}
