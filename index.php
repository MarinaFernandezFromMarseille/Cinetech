<?php

require_once __DIR__ . '/vendor/jadempinky/pinkyflow/PinkyFlow.php'; // Inclure l'autoloader de Composer

$websitename = 'Cinetech';

// Get the requested URI
$request = $_SERVER['REQUEST_URI'];

$fullurl = $_SERVER['REQUEST_URI'];
// Remove any query strings
$request = strtok($request, '?');

// Remove the base path if necessary
$basePath = '/cinetech/';
$request = str_replace($basePath, '', $request);

// Remove leading and trailing slashes
$request = trim($request, '/');

$requesttag = explode('/', $request);

$request = $requesttag[0];
if (count($requesttag) > 1) {
    $request = $requesttag[0];
    $tags = array_slice($requesttag, 1);
} else {
    $tags = '';
}
// Ensure only the .php extension is removed from the end
if (substr($request, -4) === '.php') {
    $request = substr($request, 0, -4);
}


// If the request is empty, set it to 'home' or your default page
if (empty($request)) {
    $request = 'home';
}

// Remove any "_" from the request
$request = str_replace('_', '', $request);
$request = strtolower($request);
// Construct the path to the view file
$viewPath = "App/Views/{$request}.php";
$controller = UCFIRST($request);
$controllerPath = "App/Controllers/{$controller}Controller.php";



if ($user->isLoggedIn()) {
    $role = $user->getRole();
    $isadmin = ($role === "admin") ? true : false;
} else {
    $isadmin = false;
}
// // Debugging the request string
// echo "Original request: " . $_SERVER['REQUEST_URI'] . "<br>";
// echo "Request after processing: " . $request . "<br>";
// Your API key
$apiKey = 'af77ee269d16ac7060f54ac851d43a5f';

// Check if the file exists and include it, otherwise show a 404 error
if (file_exists($viewPath)) {
    if (isset($_SESSION['previous_url'])) {
        $previouspage = $_SESSION['previous_url'];
    } else {
        $previouspage = '/cinetech/home';
    }
    if (file_exists($controllerPath)) {
        require $controllerPath;
        //echo "Controller {$controller} found.";
    } else {
        echo "Controller {$controllerPath} not found.";
    }
    
    require $viewPath;
   

    if ($fullurl != $previouspage) {
        $_SESSION['previous_url'] = $fullurl;
    }
} else {
    if (strpos($fullurl, $websitename) !== false) {
        http_response_code(404);
        require 'app/Controllers/404Controller.php';
        require 'App/Views/_404.php';
    }
}

//require_once __DIR__ . '/App/Views/index.php';
?>