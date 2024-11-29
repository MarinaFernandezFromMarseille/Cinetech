<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href="/cinetech/Assets/CSS/movieInfo.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href = "/cinetech/Assets/CSS/nav.css?v=<?php echo time(); ?>">
</head>
<body>

<?php

require './App/Views/_nav.php';

?>

<div class="container">
        <h1>Movie Info</h1>
        <div class="movie-info">
            <?php if (!empty($data['poster_path'])): 
                $posterPath = 'https://image.tmdb.org/t/p/w300' . $data['poster_path'];
                ?>
                <div class="poster-container">
                <?php
                    $idinfo = $type . "-" . $data['id'];
                if ($user->isLoggedIn() && $favorite->isFavorite($idinfo)) {
                    $isFavorite = true;
                    $watchlistIcon = "solid";
                } else {
                    $isFavorite = false;
                    $watchlistIcon = "regular";
                }
                echo "<form method='POST'>";
                echo "<input type='hidden' name='movie_id' value='{$data['id']}' />";
                echo "<input type='hidden' name='type' value='{$type}' />";
                echo "<input type='hidden' name='isfavorite' value='{$isFavorite}' />";
                echo "<button type='submit' name='watchlist' class='watchlist-button'><i class='fa-{$watchlistIcon} fa-star'></i></button>";
                echo "</form></div>";
                ?>
                    </div>
                    <img class="poster" loading="lazy" src="<?php echo $posterPath;?>" alt="Movie Poster">
                    <form method="POST">
                        <input type="hidden" name="movie_id" value="<?php echo $data['id']; ?>">
                        <input type="hidden" name="type" value="<?php echo $type; ?>">
                        <button type="submit" name="watchlist" class="watchlist-button"><i class="fa-<?php echo $watchlistIcon; ?> fa-star"></i></button>
                    </form>
                </div>
            <?php endif; ?>

            <div class="movie-details">
                <div class="detail-item"><strong>Title:</strong> <span><?php echo (!empty($data['title']) ? $data['title'] : $data['name']); ?></span></div>
                <div class="detail-item"><strong>Original Title:</strong> <span><?php echo (!empty($data['original_title']) ? $data['original_title'] : $data['original_name']); ?></span></div>
                <div class="detail-item"><strong>Release Date:</strong> <span><?php echo (!empty($data['release_date']) ? $data['release_date'] : $data['first_air_date']); ?></span></div>
                <div class="detail-item"><strong>Homepage:</strong> <a href="<?php echo $data['homepage']; ?>"><?php echo $data['homepage']; ?></a></div>
                <div class="detail-item"><strong>Production Companies:</strong>
                    <span>
                        <?php echo implode(', ', array_map(fn($company) => $company['name'], $data['production_companies'])); ?>
                    </span>
                </div>
                <div class="detail-item"><strong>Vote Average:</strong> <span><?php echo $data['vote_average']; ?></span></div>
                <div class="detail-item"><strong>Vote Count:</strong> <span><?php echo $data['vote_count']; ?></span></div>
                <?php
                    if (!empty($data['runtime'])) {
                        echo "<div class='detail-item'><strong>Runtime:</strong> <span>{$data['runtime']} minutes</span></div>";
                    } else {
                        if (!empty($seasoncounts)) {
                            echo "<div class='detail-item'><strong>Seasons:</strong> <span>{$seasoncounts}</span></div>";
                        }
                        if (!empty($episodecounts)) {
                            echo "<div class='detail-item'><strong>Episodes:</strong> <span>{$episodecounts}</span></div>";
                        }
                    }
                ?>
                <div class="detail-item"><strong>Original Language:</strong> <span><?php echo $data['original_language']; ?></span></div>
                <div class="detail-item"><strong>Status:</strong> <span><?php echo $data['status']; ?></span></div>
                <div class="detail-item"><strong>Genres:</strong>
                    <span>
                        <?php echo implode(', ', array_map(fn($genre) => $genre['name'], $data['genres'])); ?>
                    </span>
                </div>
            </div>
        </div>
        </div>

        <!-- Overview section -->
        <div class="overview-section">
            <h2>Overview</h2>
            <p><?php echo $data['overview'] ?? $data['tagline']; ?></p>
        </div>

    <!-- Comment Section -->
    <div class="comment-section">
    <h2>Comments</h2>
    <p class="num_comments">Number of comments: <?php echo count($comments_data['results']); ?></p>
    <form class="comment-form" method="POST">
        <textarea name="comment" placeholder="Write a comment..."></textarea>
        <button type="submit" name="comment_submit">Submit</button>
    </form>
    <div class="comments-container"></div>
    </div>
    <div class="see-more-container"></div>






        <!-- Cast Section with Horizontal Scroll -->
        <?php if (!empty($data['credits']['cast'])): ?>
            <div class="cast-section">
                <h2>Cast</h2>
                <div class="scrolling-wrapper">
                    <?php foreach (array_slice($data['credits']['cast'], 0, 10) as $cast): ?>
                        <div class="card">
                            <?php if ($cast['profile_path']): ?>
                                <img loading="lazy" src="https://image.tmdb.org/t/p/w92<?php echo $cast['profile_path']; ?>" alt="<?php echo $cast['name']; ?>">
                            <?php else: ?>
                                <img loading="lazy" src="placeholder.jpg" alt="No Image Available">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $cast['name']; ?></h5>
                                <p class="card-text">as <?php echo $cast['character']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>


        <?php
        if (!empty($similarmovies_data['results'])) {
            echo "<h2>You May Also Like</h2>";
            echo "<div class='similarmovies-section'>";
            foreach ($similarmovies_data['results'] as $movie) {
                $posterPath = 'https://image.tmdb.org/t/p/w500' . (!empty($movie['poster_path']) ? $movie['poster_path'] : $movie['backdrop_path']);
                echo "<div class='movie'>";
                $type = (!empty($movie['title']) ? "movie" : 'tv');
                
                // Circular progress bar for vote average
                $voteAverage = $movie['vote_average'];
                $voteAverage = round($voteAverage, 1);
                
                $degree = ($voteAverage / 10) * 360;
                if ($voteAverage == 0) {
                    $voteAverage = "N/A";
                }
                echo "<div class='circular-progress' style='--percentage: {$degree}deg;'>
                    <div class='value'>{$voteAverage}</div>
                </div>";

                echo "<a href='/cinetech/info/{$type}/{$movie['id']}'>";
                $idinfo = $type . "-" . $movie['id'];
                if ($favorite->isFavorite($idinfo)) {
                    $isFavorite = true;
                    $watchlistIcon = "solid";
                } else {
                    $isFavorite = false;
                    $watchlistIcon = "regular";
                }
                echo "<div class='poster-container'><img class='{$type}_poster' src='{$posterPath}' alt='Movie Poster' />";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='movie_id' value='{$movie['id']}' />";
                echo "<input type='hidden' name='type' value='{$type}' />";
                echo "<input type='hidden' name='isfavorite' value='{$isFavorite}' />";
                echo "<button type='submit' name='watchlist' class='watchlist-button'><i class='fa-{$watchlistIcon} fa-star'></i></button>";
                echo "</form></div>";
                echo "<h2>" . (!empty($movie['title']) ? $movie['title'] : $movie['name']) . "</h2>";
                
                // Display genres based on genre_ids
                if (!empty($movie['genre_ids'])) {
                    echo "<ul>";
                    foreach ($movie['genre_ids'] as $genreId) {
                        if (isset($genres[$genreId])) {
                            echo "<a href='/cinetech/genre/{$genreId}'><li>{$genres[$genreId]}</li></a>";
                        }
                    }
                    echo "</ul>";
                }
                
                echo "</a>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No results found.</p>";
        }
        ?>

</body>
</html>