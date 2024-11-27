<?php


if ($user->isLoggedIn()) {
    header("Location: profile");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $user->login($username, $password);
}