<?php
require_once(__DIR__ . '/../config/db.php');

class Enseignant {

    public static function getAll() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM enseignants");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM enseignants WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function ajouter($nom, $domaines_json) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO enseignants (nom, domaines) VALUES (?, ?)");
        return $stmt->execute([$nom, $domaines_json]);
    }
    

    public static function update($id, $nom, $domaines) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE enseignants SET nom = ?, domaines = ? WHERE id = ?");
        return $stmt->execute([$nom, $domaines, $id]);
    }
}
