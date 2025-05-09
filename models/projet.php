<?php
require_once(__DIR__ . '/../config/db.php');

class Projet {
    public static function ajouter($theme, $etudiantId, $binomeId ,$filiere) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO projets (theme, etudiant_id, binome_id, filiere) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$theme, $etudiantId, $binomeId, $filiere]);
    }

    public static function estBinomePris($binomeId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM projets WHERE binome_id = ?");
        $stmt->execute([$binomeId]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    public static function assignEncadreur($projetId, $enseignant_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE projets SET enseignant_id = ? WHERE id = ?");
        return $stmt->execute([$enseignant_id, $projetId]);
    }

    public static function getAll() {
        $db = Database::getConnection();
    
        $sql = "
            SELECT 
                p.id,
                p.theme,
                p.enseignant_id,  
                e1.nom AS etudiant_nom,
                e2.nom AS binome_nom,
                en.id AS encadreur_id,
                en.nom AS encadreur_nom
            FROM projets p
            INNER JOIN etudiants e1 ON p.etudiant_id = e1.id
            LEFT JOIN etudiants e2 ON p.binome_id = e2.id
            LEFT JOIN enseignants en ON p.enseignant_id = en.id
            ORDER BY p.id DESC
        ";
    
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
