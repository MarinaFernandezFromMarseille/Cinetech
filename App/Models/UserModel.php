<?php
class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance(); // Obtenir la connexion PDO
    }

    public function authenticate($username, $password) {
        // Requête pour vérifier l'utilisateur et le mot de passe
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);
        return $stmt->fetch();
    }
}
