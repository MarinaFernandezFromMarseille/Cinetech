

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/login.css?v=<?php echo time(); ?>">
    
    <title>LOGIN</title>
</head>
<body>
    <?php require './App/Views/_nav.php'; ?>


<h1>Connecte-toi Bitch!</h1>
    
<form class = "login-form" method="POST" action="/auth/login">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
</form>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Appel au modèle pour vérifier les identifiants
    $userModel = new UserModel();
    $user = $userModel->authenticate($username, $password);
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['welcome_message'] = true; // Indicateur pour afficher le message

        // Redirection vers home.php après 3 secondes
        header("Refresh: 3; URL=home.php");
        echo "Connexion réussie, redirection vers l'accueil dans 3 secondes...";
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect";
        include __DIR__ . '/../views/auth/login_view.php';
    }
} else {
    include __DIR__ . '/../views/auth/login_view.php';
}
?>


</body>
</html>
