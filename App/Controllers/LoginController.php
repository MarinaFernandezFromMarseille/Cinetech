<?php


if ($user->isLoggedIn()) {
    header("Location: home");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $user->login($username, $password);
}