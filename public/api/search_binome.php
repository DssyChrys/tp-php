<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__, 2) . '/models/etudiant.php';


$term = $_GET['term'] ?? '';

if ($term) {
    $results = Etudiant::searchByName($term); 
    $names = array_map(function($etudiant) {
        return $etudiant['nom'];
    }, $results);
    echo json_encode($names);
} else {
    echo json_encode([]);
}
