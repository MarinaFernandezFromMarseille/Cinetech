

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Assets/CSS/nav.css?v=<?php echo time(); ?>">
    
    <title>LOGIN</title>
</head>
<body>



<h1>Connexion</h1>
    
<form class = "login-form" method="POST">

    <label for="username">Nom d'utilisateur ou  email:</label>
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <label for="password">Mot de passe:</label>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
</form>
<section class = "links">
<a href = "home.php">Retour à l'accueil</a>
<a href = "sign_in.php">Créer un compte</a>
</section>

</body>
</html>
