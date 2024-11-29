<?php


if ($user->isLoggedIn()) {
    header("Location: profile");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $output = $user->login($username, $password);
    if ($output) {
        header("Location: profile");
    } else {
        echo "Invalid username or password.";
    }
}