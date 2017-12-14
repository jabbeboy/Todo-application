<?php
require('db.php');

function db_connection()
{
    return $db = new Database();
}

function checkConnection()
{
    return db_connection()->established_conn();
}

function lookupUser($user)
{
    return db_connection()->select_user($user);
}

function getAllTasks($user)
{
    return db_connection()->select_all_tasks($user);
}

function getTasks($user, $status)
{
    return db_connection()->select_tasks($user, $status);
}

function addNewTask($task)
{
    return db_connection()->insert_task($task);
}

function getTask($task_id, $user)
{
    return db_connection()->select_task($task_id, $user);
}

function deleteTask($task_id, $user)
{
    return db_connection()->delete_task($task_id, $user);
}

function updateTask($task)
{
    return db_connection()->update_task($task);
}

function addUser($user)
{
    return db_connection()->insert_user($user);
}
