<?php

if (isset($_POST['logout'])) {
            $user->logout();
        }

if ($user->isLoggedIn()) {
            $user->setLastLogin();
            $user->setLastIp($_SERVER['REMOTE_ADDR']);
        }

if (isset($_POST['edit'])) {
            $user->setUsername($_POST['username']);
            $user->edit();
        }
