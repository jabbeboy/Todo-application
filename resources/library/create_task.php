<?php
session_start();
require('functions.php');
require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

// Get user details
$user = getUser($session->getUserSession());

if (isset($_POST['addtask'])) {
    $task = array(
        'title' => htmlspecialchars(strip_tags($_POST['title'], ENT_QUOTES)),
        'description' => nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8')),
        'author_id' => $user['id'],
        'added_date' => date("Y-m-d"),
        'end_date' => $_POST['end_date'],
        'status' => 'todo'
    );

    // Add task
    addNewTask($task);
    header ("Location: todolist.php");
    exit();
}
else {
    header("Location: todolist.php");
    exit();
}