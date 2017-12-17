<?php
session_start();
require('functions.php');
require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

if (!checkConnection()){
    include('alert-danger-popup.php');
    exit();
}
// Get user details
$user = getUser($session->getUserSession());

// Get priority of tasks
$priority = getTaskByPriority($user['id']);
?>
    <!-- INCLUDE HEADER -->
<?php
include('header.html');
?>
    <div class="todo_page" style="font-family: Arial, serif; font-size: 16px">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3><?php
                    echo $user['name'];
                    ?></h3>
            </div>

            <div class="panel-body">

                <?php // No tasks created for the chosen name, print out alert.
                if (empty(getAllTasks($user['id']))) {
                    echo "<div class='alert alert-info'>No task added..</div>";
                } else {
                    // Print todo tasks
                    if (!empty(getTasks($user['id'], 'ongoing'))) {

                        echo "<table class='table table-borderless' style='font-size: 16px' > 
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>";
                        foreach (getTasks($user['id'], 'ongoing') as $task) {

                            echo "<tbody>
                                <tr>
                                    <td style='text-align: left'>";

                            // Priority label is printed on each task
                            if (!empty($priority)) {
                                foreach ($priority as $p) {
                                    if ($p->status === 'ongoing') {
                                        echo "<span class='label label-danger'>Priority</span>&nbsp;";
                                        break;
                                    }
                                }
                            }

                            echo "<span class='label label-warning'>Ongoing</span>
                                    </td>
                                    <td style='text-align: center'>
                                        <a href='#' id='task_popover' data-trigger='focus' data-toggle='popover' title='" . $task->title . "'
                                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                                            </p>'>$task->title
                                        </a>
                                    </td>
                                    <td style='text-align: right'>
                                        <a class='btn btn-success btn-lg' name='finished' href='action.php?action=finished&id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-ok'></span>
                                        </a>
                                    
                                        <a class='btn btn-lg btn-default' name='edit' href='edit.php?id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-pencil'></span>
                                        </a>
                                       
                                    </td>
                                </tr>
                            </tbody>";
                        }
                    }
                    echo "</table>";

                    if (!empty(getTasks($user['id'], 'todo'))) {
                        // TO-DO TABLE
                        echo "<table class='table table-borderless' style='font-size: 16px;' >
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>";
                        foreach (getTasks($user['id'], 'todo') as $task) {
                            echo "<tbody>
                                <tr>
                                    <td style='text-align: left'>";

                            // Priority label is printed on each task
                            if (!empty($priority)) {
                                foreach ($priority as $p) {
                                    if ($p->status === 'todo') {
                                        echo "<span class='label label-danger'>Priority</span>&nbsp;";
                                        break;
                                    }
                                }
                            }
                            echo "<span class='label label-info'>Todo</span>
                                    </td>
                                    <td style='text-align: center'>
                                        <a href='#' id='task_popover' data-trigger='focus' data-toggle='popover' data-placement='auto'
                                            title='" . $task->title . "'
                                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                                            </p>'>$task->title
                                        </a>
                                    </td>
                                    <td style='text-align: right'>
                                        <a class='btn btn-info btn-lg' name='edit' href='action.php?action=start&id=" . $task->id . "' style='margin-bottom: 5px; margin-top: 5px'>
                                            <span class='glyphicon glyphicon-play'></span>
                                        </a>
                                        <a class='btn btn-default btn-lg' name='edit' href='edit.php?id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-pencil'></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>";
                            }
                        }
                        echo "</table>";

                    if (!empty(getTasks($user['id'], 'finished'))) {
                        echo "<table class='table table-borderless' style='font-size: 16px' >
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>";
                        foreach (getTasks($user['id'], 'finished') as $task) {
                            echo "<tbody>
                                <tr>
                                    <td style='text-align: left'>
                                        <span class='label label-success'>Finished</span>&nbsp;
                                    </td>
                            
                                    <td style='text-align: center'>
                                        <a href='#' id='task_popover' data-trigger='focus' data-toggle='popover' data-placement='auto'
                                            title='" . $task->title . "'
                                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                                            </p>'>$task->title
                                        </a>
                                    </td>
                                    <td style='text-align: right'>
                                    
                                        <a class='btn btn-lg btn-danger' name='edit' href='action.php?action=delete&id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-trash'></span>
                                        </a>
                                        <a class='btn btn-lg btn-default' name='edit' href='edit.php?id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-pencil'></span>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>";
                        }
                        echo "</table>";
                    }
                }
                ?>

                <a type='submit' href="exit.php" name='exit' class='btn btn-danger btn-lg'>
                    <span class='glyphicon glyphicon-log-out'></span> Exit
                </a>

                <a class="btn btn-success btn-lg" name="newtask" href="newtask.php">
                    <span class='glyphicon glyphicon-plus'></span> New Task
                </a>

            </div>
        </div>
    </div>

    <!-- INCLUDE FOOTER -->
<?php
include('footer.html');
?>