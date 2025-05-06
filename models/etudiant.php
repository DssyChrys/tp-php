<?php
require_once(__DIR__ . '/../config/db.php');

class Etudiant {
    public static function getAll() {
        global $db;
        $query = $db->query("SELECT * FROM etudiants");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public static function ajouter($nom, $email, $motdepasse) {
        global $db;
        $hashedPassword = password_hash($motdepasse, PASSWORD_BCRYPT);
        $stmt = $db->prepare("INSERT INTO etudiants (nom, email, motdepasse) VALUES (?, ?, ?)");
        return $stmt->execute([$nom, $email, $hashedPassword]);
    }

    public static function update($id, $nom, $email) {
        global $db;
        $stmt = $db->prepare("UPDATE etudiants SET nom = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nom, $email, $id]);
    }
}
