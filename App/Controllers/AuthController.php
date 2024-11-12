<?php

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Appel au modèle pour vérifier les identifiants
            $userModel = new UserModel();
            $user = $userModel->authenticate($username, $password);
            
            if ($user) {
                // Stocker l'utilisateur en session
                $_SESSION['user'] = $user;
                header("Location: /dashboard");
                exit;
            } else {
                // Gérer les erreurs (renvoyer à la vue avec un message d'erreur)
                $error = "Nom d'utilisateur ou mot de passe incorrect";
                include "views/login_view.php";
            }
        } else {
            // Afficher le formulaire
            include "views/login_view.php";
        }
    }
}

