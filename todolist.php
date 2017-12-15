<?php
session_start();
require('functions.php');
require('session.php');
if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

$user = getUser($_SESSION['current_user']);
$priority = getTaskByPriority($user['id']);

?>s
    <!-- INCLUDE HEADER -->
<?php
include('header.html');
?>
    <div class="todo_page">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h4><?php
                    echo $_SESSION['current_user'];
                    ?></h4>
            </div>

            <div class="panel-body">

                <?php // No tasks created for the chosen name, print out alert.
                if (empty(getAllTasks($user['id']))) {
                    echo "<div class='alert alert-info'>No task added..</div>";
                } else {
                    // Print todo tasks
                    if (!empty(getTasks($user['id'], 'ongoing'))) {

                        echo "<table class='table table-borderless'>
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
                                    <td>";

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
                                    <td>
                                        <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto'
                                            title='" . $task->title . "'
                                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                                            </p>'>$task->title
                                        </a>
                                    </td>
                                    <td>
                                        <a class='btn btn-default btn-primary-spacing' name='edit' href='edit.php?id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-pencil'></span>
                                        </a>
                                        <a class='btn btn-success btn-primary-spacing' name='finished' href='action.php?action=finished&id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-ok'></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>";
                        }
                    }
                    echo "</table>";

                    if (!empty(getTasks($user['id'], 'todo'))) {
                        // TO-DO TABLE
                        echo "<table class='table table-borderless'>
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
                                    <td>";

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
                                    <td>
                                        <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto'
                                            title='" . $task->title . "'
                                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                                            </p>'>$task->title
                                        </a>
                                    </td>
                                    <td>
                                        <a class='btn btn-info btn-primary-spacing' name='edit' href='action.php?action=start&id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-play'></span>
                                        </a>
                                        <a class='btn btn-default btn-primary-spacing' name='edit' href='edit.php?id=" . $task->id . "'>
                                            <span class='glyphicon glyphicon-pencil'></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>";
                            }
                        }
                        echo "</table>";

                    if (!empty(getTasks($user['id'], 'finished'))) {
                        echo "<table class='table table-borderless'>
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
                                    <td>
                                        <span class='label label-success'>Finished</span>
                                    </td>
                            
                                    <td>
                                        <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto'
                                            title='" . $task->title . "'
                                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                                            </p>'>$task->title
                                        </a>
                                    </td>
                                    <td>
                                        <a class='btn btn-default btn-primary-spacing' name='edit' href='edit.php?id=" . $task->id . "'>
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

                <a type='submit' href="exit.php" name='exit' class='btn btn-danger'>
                    <span class='glyphicon glyphicon-log-out'></span> Exit
                </a>

                <a class="btn btn-success" name="newtask" href="newtask.php">
                    <span class='glyphicon glyphicon-plus'></span> New Task
                </a>

            </div>
        </div>
    </div>

    <!-- INCLUDE FOOTER -->
<?php
include('footer.html');
?>