<?php

class AuthController {
    public function login() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $userModel = new UserModel();
            $user = $userModel->authenticate($username, $password);
            
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['welcome_message'] = true;

                header("Refresh: 3; URL=home.php");
                echo "Connexion réussie, redirection vers l'accueil dans 3 secondes...";
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect";
                include __DIR__ . '../Views/login.php';
            }
        } else {
            include __DIR__ . '../Views/login.php';
        }
    }
}
