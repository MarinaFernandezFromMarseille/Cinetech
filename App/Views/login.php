

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
    
<form class = "login-form" method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
</form>

</body>
</html>
