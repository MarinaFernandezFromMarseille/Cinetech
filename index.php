<?php

require_once __DIR__ . '/vendor/jadempinky/pinkyflow/PinkyFlow.php';

// Get the requested URI
$request = $_SERVER['REQUEST_URI'];

// Remove any query strings
$request = strtok($request, '?');

// Remove the base path if necessary
$basePath = '/cinetech/';
$request = str_replace($basePath, '', $request);

// Remove leading and trailing slashes
$request = trim($request, '/');
// Ensure only the .php extension is removed from the end
if (substr($request, -4) === '.php') {
    $request = substr($request, 0, -4);
}


// If the request is empty, set it to 'home' or your default page
if (empty($request)) {
    $request = 'home';
}

// Construct the path to the view file
$viewPath = "App/Views/{$request}.php";
$controller = UCFIRST($request);
$controllerPath = "App/Controllers/{$controller}Controller.php";


// // Debugging the request string
// echo "Original request: " . $_SERVER['REQUEST_URI'] . "<br>";
// echo "Request after processing: " . $request . "<br>";

// Check if the file exists and include it, otherwise show a 404 error
if (file_exists($viewPath)) {
    if (file_exists($controllerPath)) {
        require $controllerPath;
        //echo "Controller {$controller} found.";
    } else {
        //echo "Controller {$controller} not found.";
    }
    require $viewPath;
    
} else {
    echo "View {$request} not found.";
    // http_response_code(404);
    // require 'App/Views/404.php';
}

//require_once __DIR__ . '/App/Views/index.php';
?>
