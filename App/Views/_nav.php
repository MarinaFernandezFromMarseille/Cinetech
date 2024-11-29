
<nav>
        <a href = "/cinetech/home.php"><img class = "logo" src="Assets/Images/logocinetech.webp" alt="logo"></a>
        <a href="https://github.com/MarinaFernandezFromMarseille/Cinetech">GitHub</a>
        <a href="https://82.165.185.52:8443/smb/web/view">Plesk</a>
<form class = "search-form" action="" method="get">
    <input type="text" name="query" placeholder="Search..." required>
    </form>
    <?php
    if ($user->isLoggedIn()) {
        ?>
        <a href = "profile.php"><img class = "profil_icon" src="Assets/Images/utilisateur.png" alt="profil_icon"></a>
        <?php
    } else {
        ?>
        <a href="/cinetech/login.php">Se connecter</a>
        <a href = "/cinetech/sign_in.php">S'inscrire</a>
        <?php
    }
    ?>


    </nav>
    <nav class = "navbar2">
        <select>
            <option value="films0">Series</option>
            <option value="films1">Horreur</option>
            <option value="films2">Action</option>
            <option value="films3">Fantastique</option>
            <option value="films4">Drame</option>
            <option value="films5">Thriller</option>
            <option value="films6">Comédie</option>
            <option value="films7">Romance</option>
            <option value="films8">Aventure</option>
            <option value="films9">Animation</option>
            <option value="films10">Documentaire</option>
            <option value="films11">Science-fiction</option>
            <option value="films12">Musical</option>
            <option value="films13">Historique</option>
            <option value="films14">Western</option>
            <option value="films15">Mystère</option>
            <option value="films16">Biographie</option>
            <option value="films17">Guerre</option>
            <option value="films18">Policier</option>

        </select>
        <select>
            <option value="series0">Films</option>
            <option value="series1">Horreur</option>
            <option value="series2">Action</option>
            <option value="series3">Fantastique</option>
            <option value="series4">Drame</option>
            <option value="series5">Thriller</option>
            <option value="series6">Comédie</option>
            <option value="series7">Romance</option>
            <option value="series8">Aventure</option>
            <option value="series9">Animation</option>
            <option value="series10">Documentaire</option>
            <option value="series11">Science-fiction</option>
            <option value="series12">Musical</option>
            <option value="series13">Historique</option>
            <option value="series14">Western</option>
            <option value="series15">Mystère</option>
            <option value="series16">Biographie</option>
            <option value="series17">Guerre</option>
            <option value="series18">Policier</option>

        </select>

    </nav>
    </body>
    </html>