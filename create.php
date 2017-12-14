<?php
session_start();
require('functions.php');
require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

$user = getUser($_SESSION['current_user']);

if (isset($_POST['addtask'])) {

    $task = array(
        'title' => htmlspecialchars(strip_tags($_POST['title'], ENT_QUOTES)),
        'description' => nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8')),
        'author' => '',
        'added_date' => date("Y-m-d"),
        'end_date' => $_POST['end_date'],
        'status' => 'todo'
    );

    var_dump(getUser($_SESSION['current_user']));

    // User does not exist in table
    if (empty(getUser($_SESSION['current_user']))) {

        addUser($_SESSION['current_user']);

        $task['author'] = $user['id'];
        var_dump($task);
        //var_dump($task);
        addNewTask($task);

        header("Location: todolist.php");
    }
    // User exist already
    else {
        $task['author'] = $user['id'];
        var_dump($task);
        addNewTask($task);

        header("Location: todolist.php");
    }
}
