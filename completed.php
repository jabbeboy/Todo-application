<?php
session_start();
require('functions.php');
require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['current_user'])) {

    // Set task status (1 = finished, 0 = not finished (default)).
    $task = [
        'id' => $_GET['id'],
        'author' => $_SESSION['current_user'],
        'finished' => 1
    ];

    setTaskStatus($task);
    header('Location: todolist.php');
}