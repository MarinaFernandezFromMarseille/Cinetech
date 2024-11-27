

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="Assets/CSS/profile.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="profile-container">
        <form action="update_profile.php" method="POST" class="profile-form">
            <div class="profile-header">
                <h1 class="profile-username">Bonjour, <?php echo $user->getUsername(); ?></h1>
                <p class="profile-email"><?php echo $user->getEmail(); ?></p>
            </div>
            <div class="profile-actions">
                <button type="submit" class="btn save-btn">Enregistrer les modifications</button>

        </div>
            <div class="profile-details">
                <h2>Détails du profil</h2>
                <ul>
                    <li><strong>Nom :</strong> <input type="text" name="username" value="<?php echo htmlspecialchars($user->getUsername()); ?>" required></li>
                    <li><strong>Email :</strong> <input type="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" required></li>
                    <li><strong>Date d'inscription :</strong> <p><?php echo $user->getCreated(); ?></p></li>
                </ul>
            </div>
        </form>
        <?php
                // Handle logout
        if ($user->isLoggedIn()) {
            echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post"><button type="submit" name="logout">Logout</button></form>';
        }
        ?>
    </div>
</body>
</html>
