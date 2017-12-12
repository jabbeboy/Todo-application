<?php

require('functions.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['current_user'])) {

    // Delete the task
    deleteTask($_GET['id'], $_SESSION['current_user']);
    header('Location: todolist.php');
}