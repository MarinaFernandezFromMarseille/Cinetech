<?php

if (!$user->isLoggedIn()) {
    header('Location: login');
}

if (isset($_POST['logout'])) {
            $user->logout();
            header('Location: home');
        }

if ($user->isLoggedIn()) {
            $user->setLastLogin();
            $user->setLastIp($_SERVER['REMOTE_ADDR']);
        }

if (isset($_POST['edit'])) {
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);
            header('Location: profile');
        }
