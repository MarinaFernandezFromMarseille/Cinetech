<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['first_name'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];


    $user->register($username, $password, $confirmPassword, $email);       
    
    // Redirection vers login.php
    header('Location: login');
    exit(); // S'assurer que le script s'arrête après la redirection
} 

