<?php
session_start();
require('functions.php');
require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['addtask'])) {

    $name = $_SESSION['current_user'];

    $task = array(
        'title' => htmlspecialchars(strip_tags($_POST['title'], ENT_QUOTES)),
        'description' => nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8')),
        'author' => $name,
        'added_date' => date("Y-m-d"),
        'end_date' => $_POST['end_date'],
        'status' => 'todo'
    );

    // User does not exist in table
    if (empty(lookupUser($name))) {

        // add name in db
        addUser($name);

        // add task to db
        addNewTask($task);

        header("Location: todolist.php");
    }
    // User exist already
    else {

        // Add task directly to database
        addNewTask($task);
        header("Location: todolist.php");
    }
}
