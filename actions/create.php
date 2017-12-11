<?php

require('../functions.php');
require('../session.php');

if (!$session->sessionIsSet()) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['addtask'])) {

    $task = [
        'title' => htmlspecialchars(strip_tags($_POST['title'], ENT_QUOTES)),
        'description' => nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8')),
        'author' => $_SESSION['current_user'],
        'added_date' => date("Y-m-d"),
        'end_date' => $_POST['end_date'],
        'finished' => 0
    ];

    addNewTask($task);
    header("Location: ../todolist.php");
}







