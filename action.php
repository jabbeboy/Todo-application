<?php
session_start();

require('functions.php');
require('session.php');


if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

$task = array();

// Make sure a session of user is started
if (isset($_SESSION['current_user'])) {

    $action = $_GET['action'];
    $task_id = $_GET['id'];

    $task = getTask($task_id, $_SESSION['current_user']);

    $task_array = [
        'id' => $task->id,
        'title' => $task->title,
        'description' => $task->description,
        'author' => $task->author,
        'added_date' => $task->added_date,
        'end_date' => $task->end_date,
        'status' => $task->status
    ];

    var_dump($task_array);

    // Used for changing finished task or start task.
    if (isset($action)) {
        switch ($action) {
            case 'start':
                $task_array['status'] = 'ongoing';
                updateTask($task_array);
                break;

            case 'finished':
                $task_array['status'] = 'finished';
                updateTask($task_array);
                break;

            case 'delete':
                deleteTask($task_id, $_SESSION['current_user']);
                break;
        }
        header('Location: todolist.php');
    }

    //Saving edited task
    else if (isset($_POST['save'])) {

        $task = [
            'id' => $_POST['id'],
            'title' => htmlspecialchars(strip_tags($_POST['title'], ENT_QUOTES)),
            'description' => nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8')),
            'author' => $_SESSION['current_user'],
            'added_date' => date("Y-m-d"),
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status']
        ];

        var_dump($task);

        updateTask($task);
        header("Location: todolist.php");
    }
}




