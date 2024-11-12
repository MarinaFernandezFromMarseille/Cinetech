<?php
class HomeController {
    private $tmdbService;

    public function __construct() {
        $this->tmdbService = new TMDbService();
    }

    public function showPopularMovies() {
        $movies = $this->tmdbService->fetchPopularMovies();
        include __DIR__ . '/../views/movies/movie_list_view.php';
    }

    public function showMovieDetails($movieId) {
        $movie = $this->tmdbService->fetchMovieDetails($movieId);
        include __DIR__ . '/../views/movies/movie_detail_view.php';
    }
}
