<?php
class TMDbService {
    private $apiKey;
    private $baseUrl;

    public function __construct() {
        $config = include __DIR__ . '/../config/tmdb.php';
        $this->apiKey = $config['api_key'];
        $this->baseUrl = $config['base_url'];
    }

    public function fetchPopularMovies() {
        $url = "{$this->baseUrl}movie/popular?api_key={$this->apiKey}";
        return $this->makeRequest($url);
    }

    public function fetchMovieDetails($movieId) {
        $url = "{$this->baseUrl}movie/{$movieId}?api_key={$this->apiKey}";
        return $this->makeRequest($url);
    }

    private function makeRequest($url) {
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}
