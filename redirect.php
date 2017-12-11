<?php
session_start();

require ('functions.php');
require ('session.php');

// 1. Access by session
if (isset($_POST['choose'])) {

// Set current user session
    if (isset($_POST['name'])) {
        $session->setSession($_POST['name']);
    }

// Set cookie for remember user
    if (isset($_POST['rememberme'])) {
        setcookie("current_user", $_POST['name'], time() + (86400 * 30), "/");
    }

    header("Location: todolist.php");
}

// 2. Access by saved cookie
if (isset($_COOKIE['current_user'])) {

    // Set current user session from cookie
    $session->setSession($_COOKIE['current_user']);
    header("Location: todolist.php");
}






