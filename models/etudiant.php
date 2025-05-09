<?php
require_once(__DIR__ . '/../config/db.php');

class Etudiant {

    public static function getAll() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM etudiants");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public static function ajouter($nom, $email, $password) {
        $db = Database::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare("INSERT INTO etudiants (nom, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$nom, $email, $hashedPassword]);
    }

    public static function update($id, $nom, $email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE etudiants SET nom = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nom, $email, $id]);
    }

    public static function getByEmail($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM etudiants WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByName($nom) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM etudiants WHERE nom = :nom");
        $stmt->execute(['nom' => $nom]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function searchByName($term) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT nom FROM etudiants WHERE nom LIKE :term LIMIT 10");
        $stmt->execute(['term' => "%$term%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
