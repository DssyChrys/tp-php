<?php
require_once(__DIR__ . '/../config/db.php');

class Enseignant {
    public static function getAll() {
        global $db;
        $query = $db->query("SELECT * FROM enseignants");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM enseignants WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public static function ajouter($nom, $domaines) {
        global $db;
        $stmt = $db->prepare("INSERT INTO enseignants (nom, domaines) VALUES (?, ?)");
        return $stmt->execute([$nom, $domaines]);
    }

    public static function update($id, $nom, $domaines) {
        global $db;
        $stmt = $db->prepare("UPDATE enseignants SET nom = ?, domaines = ? WHERE id = ?");
        return $stmt->execute([$nom, $domaines, $id]);
    }
}
