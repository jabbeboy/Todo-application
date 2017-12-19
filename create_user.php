<?php
session_start();
require('functions.php');
require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

// Redirected from redirect.php can only create user.
if (isset($_POST['create_user']))  {

// Add user
    addUser($session->getUserSession());
    unset($_POST['create_user']);
    header("Location: todolist.php");
    exit();
}
else {
    header("Location: todolist.php");
    exit();
}
