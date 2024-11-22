<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Assets/CSS/sign_in.css?v=<?php echo time(); ?>">
</head>
<body>
    <h1>Créer un compte</h1>
<form class="register-form" method="POST">
    <input type="text" name="first_name" placeholder="Prénom" required>
    <input type="text" name="last_name" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="password" name="confirm_password" placeholder="Confirmer mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>
   
</body>
</html>

