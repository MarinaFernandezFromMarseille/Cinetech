<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinetech</title>
    <link rel="stylesheet" href="Assets/CSS/home.css?v=<?php echo time(); ?>">
</head>
<body>
   
<?php

require './App/Views/_nav.php';

?>
    
  <section id="carousel-section">
    <div class="carousel">
      <div class="carousel-images">
        <div class="carousel-item active">
          <img src="Assets/Images/animes.jpeg" alt="Image 1 description">
        </div>
        <div class="carousel-item">
          <img src="Assets/Images/téléchargé.jpeg" alt="Image 2 description">
        </div>
        <div class="carousel-item">
          <img src="Assets/Images/films2024.jpeg" alt="Image 3 description">
        </div>
      </div>

      <div class="carousel-indicators">
        <span class="indicator active" onclick="currentSlide(0)"></span>
        <span class="indicator" onclick="currentSlide(1)"></span>
        <span class="indicator" onclick="currentSlide(2)"></span>
      </div>
    </div>
  </section>
 
  <script src = "Assets/JS/carousel.js"></script>

  <section class="les_mieux_notés">
    <h1>⭐Les mieux notés</h1>
    
    <!-- Flèche de gauche -->
    <button class="carousel-btn left-btn">←</button>
    
    <!-- Carousel -->
    <section class="carousel2">
        <div class="films">
            <?php
            $apiKey = '70d375e0eac50893924ca1b0f38c5d1d';
            $endpoint = "https://api.themoviedb.org/3/movie/popular?api_key=$apiKey";

            // Initialisation de cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Exécution de la requête
            $response = curl_exec($ch);
            curl_close($ch);

            // Décodage et affichage des données
            $data = json_decode($response, true);
            foreach ($data['results'] as $movie) {
                $posterPath = 'https://image.tmdb.org/t/p/w500' . $movie['backdrop_path'];
                echo '<div class="film">';
              
                echo '<img class="film_img" src="' . htmlspecialchars($posterPath) . '" alt="' . htmlspecialchars($movie['title']) . '"/>';
               echo '<h2>' . htmlspecialchars($movie['title']) . '</h2>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
    
    <!-- Flèche de droite -->
    <button class="carousel-btn right-btn">→</button>
</section>




<script src = "Assets/JS/carousel.js?t=<?php echo time(); ?>"></script>

</body>
</html>