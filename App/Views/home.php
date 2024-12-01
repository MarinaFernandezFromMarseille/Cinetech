<?php

// Affichage du message de bienvenue si l'indicateur est présent
if (isset($_SESSION['welcome_message']) && $_SESSION['welcome_message']) {
  echo "<h1>Bonjour, " . htmlspecialchars($firstname) . " !</h1>";
  unset($_SESSION['welcome_message']); // Supprimer l’indicateur après affichage
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinetech</title>
  <link rel="stylesheet" href="Assets/CSS/home.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="Assets/CSS/nav.css?v=<?php echo time(); ?>">
</head>

<body> 
<?php
require './App/Views/_nav.php';

?>

  <section id="carousel-section">
    <div class="carousel">
      <div class="carousel-images">
        <div class="carousel-item active">
          <img src="Assets/Images/124666.webp" alt="Image 1 description">
        </div>
        <div class="carousel-item">
          <img src="Assets/Images/Affiches2711.jpg" alt="Image 2 description">
        </div>
        <div class="carousel-item">
          <img src="Assets/Images/Affiches3010.jpg" alt="Image 3 description">
        </div>
      </div>

      <div class="carousel-indicators">
        <span class="indicator active" onclick="currentSlide(0)"></span>
        <span class="indicator" onclick="currentSlide(1)"></span>
        <span class="indicator" onclick="currentSlide(2)"></span>
      </div>
    </div>
  </section>


  <section class="films-container">
    <section class="les_mieux_notés">
      <h1>Populaires 🍿</h1>
      <!-- Carousel -->
      <section class="carousel2"> <div class="films"> <?php

      // Décodage et affichage des données
      foreach ($popularMovies['results'] as $movie) {
        $rating = $movie['vote_average'];
        $posterPath = 'https://image.tmdb.org/t/p/original' . $movie['poster_path'];
        echo '<div class="film"><a href="movieInfo/movie/' . $movie['id'] . '">';

        echo '<div class="rating">'."⭐" . $rating . '</div>';
        echo '<img class="film_img" src="' . htmlspecialchars($posterPath) . '" alt="' . htmlspecialchars($movie['title']) . '"/>';
      
        echo '</a></div>';
      }
      ?>
        </div>
    </section>
  </section>

  <section class="les_mieux_notés">
    <h1>Les mieux notés 🍿</h1>

   

    <!-- Carousel -->
    <section class="carousel2"> <div class="films"> <?php

    // Décodage et affichage des données
    foreach ($topRatedMovies['results'] as $movie) {
      $rating = $movie['vote_average'];
      $posterPath = 'https://image.tmdb.org/t/p/original' . $movie['poster_path'];
      echo '<div class="film"><a href="movieInfo/movie/' . $movie['id'] . '">';


      echo '<div class="rating">'."⭐" . $rating . '</div>';
      echo '<img class="film_img" src="' . htmlspecialchars($posterPath) . '" alt="' . htmlspecialchars($movie['title']) . '"/>';
    
      echo '</a></div>';
    }
    ?>
      </div>
  </section>
  </section>

  <section class="les_mieux_notés">
    <h1>A venir 🍿</h1>

    <!-- Carousel -->
    <section class="carousel2"> <div class="films"> <?php

    // Décodage et affichage des données
    foreach ($upComingMovies['results'] as $movie) {
      $rating = $movie['vote_average'];
      $posterPath = 'https://image.tmdb.org/t/p/original' . $movie['poster_path'];
      echo '<div class="film"><a href="movieInfo/movie/' . $movie['id'] . '">';


      echo '<div class="rating">'."⭐" . $rating . '</div>';
      echo '<img class="film_img" src="' . htmlspecialchars($posterPath) . '" alt="' . htmlspecialchars($movie['title']) . '"/>';
  
      echo '</a></div>';
    }
    ?>
      </div>
  </section>


  </section>


  <section class="les_mieux_notés">
    <h1>En ce moment 🍿</h1>

    <!-- Carousel -->
    <section class="carousel2"> <div class="films"> <?php

    // Décodage et affichage des données
    foreach ($nowPlayingMovies['results'] as $movie) {
      $rating = $movie['vote_average'];
      $posterPath = 'https://image.tmdb.org/t/p/original' . $movie['poster_path'];
      echo '<div class="film"><a href="movieInfo/movie/' . $movie['id'] . '">';

      echo '<div class="rating">';
      echo '<div class = "note">' .'⭐'. $rating . '</div>';
      echo '</div>';
      echo '<img class="film_img" src="' . htmlspecialchars($posterPath) . '" alt="' . htmlspecialchars($movie['title']) . '"/>';
   
      echo '</a></div>';
    }
    ?>
      </div>
      </div>
  </section>

  </section>
  </section>



  <?php
require './App/Views/_footer.php';

?>
  <script src="Assets/JS/script.js?t=<?php echo time(); ?>"></script>
  </body>

</html>