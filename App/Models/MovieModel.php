<?php
class Movie {
    private $apiKey = 'cb5b4d9e55721b38a4fb8f7988f5a804'; // Remplacez par votre clé API TMDb

    /**
     * Récupérer les films populaires
     */
    public function getPopular() {
        $url = 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc' . "&api_key=" . $this->apiKey . "&language=en-US&page=1";
        $response = file_get_contents($url);
        if ($response === false) {
            return []; // En cas d'erreur, renvoyer un tableau vide
        }
        $data = json_decode($response, true);
        return $data['results'] ?? []; // Renvoyer les résultats ou un tableau vide
    }
    
    /**
     * Récupérer les films les mieux notés
     */
    public function getTopRated() {
        $url = "https://api.themoviedb.org/3/movie/top_rated?api_key=" . $this->apiKey . "&language=en-US&page=1";
        $response = file_get_contents($url);
        return json_decode($response, true)['results'] ?? [];
    }

    /**
     * Récupérer les films à venir
     */
    public function getUpcoming() {
        $url = "https://api.themoviedb.org/3/movie/upcoming?api_key=" . $this->apiKey . "&language=en-US&page=1";
        $response = file_get_contents($url);
        return json_decode($response, true)['results'] ?? [];
    }

    /**
     * Récupérer les films actuellement au cinéma
     */
    public function getNowPlaying() {
        $url = "https://api.themoviedb.org/3/movie/now_playing?api_key=" . $this->apiKey . "&language=en-US&page=1";
        $response = file_get_contents($url);
        return json_decode($response, true)['results'] ?? ["no results"];
    }
}
