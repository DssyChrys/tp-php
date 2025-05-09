<?php
class Database {
    private static $db = null;

    public static function getConnection() {
        if (self::$db === null) {
            try {
                self::$db = new PDO('mysql:host=localhost;dbname=tp_php', 'root', '');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur BDD : " . $e->getMessage());
            }
        }
        return self::$db;
    }
}
