<?php
session_start();

require('functions.php');
require('session.php');

// 1. Access by choosing name
if (isset($_POST['choose'])) {

    // Set current user session
    if (isset($_POST['name'])) {
        $session->setSession($_POST['name']);
    }

    // Set cookie for remember user
    if (isset($_POST['rememberme'])) {
        setcookie("current_user", $_POST['name'], time() + (86400 * 30), "/");
    }

    // No user exist in db, creating a new.
    if (empty(getUser($session->getUserSession()))) {
        $_POST['create_user'] = 'true';
        header("Location: create_user.php");
        exit();
    }

    header("Location: todolist.php");
    exit();
}

else if ($_SESSION['current_user']) {
    header("Location: todolist.php");
    exit();
}

// 2. Access by saved cookie
else if (isset($_COOKIE['current_user'])) {
    // Set current user session from cookie
    $session->setSession($_COOKIE['current_user']);
    header("Location: todolist.php");
    exit();
}
else {
    header("Location: index.php");
    exit();
}



