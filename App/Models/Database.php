<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = 'localhost';
        $db = 'nom_de_la_base';
        $user = 'nom_utilisateur';
        $pass = 'mot_de_passe';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new Exception('Erreur de connexion à la base de données: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
