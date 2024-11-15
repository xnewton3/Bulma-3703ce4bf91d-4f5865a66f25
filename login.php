<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$loginType = $_POST['login_type'];
$enteredPassword = $_POST['password'];

$correctPassword = '';
$redirectPage = '';

if ($loginType === 'coach') {
    $correctPassword = $_ENV['COACH_PASSWORD'];
    $redirectPage = 'coach.php';
} elseif ($loginType === 'admin') {
    $correctPassword = $_ENV['ADMIN_PASSWORD'];
    $redirectPage = 'admin.php';
}

if ($enteredPassword === $correctPassword) {
    header("Location: $redirectPage");
    exit();
} else {
    echo "Password is incorrect.";
    exit();
}
?>