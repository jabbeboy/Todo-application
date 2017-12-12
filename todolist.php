<?php
session_start();
require ('functions.php');
require ('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}
?>

    <!-- INCLUDE HEADER -->
<?php include ('header.html'); ?>
    <div class="todo_page">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h2><b><?php echo $_SESSION['current_user']; ?></b></h2>
            </div>

            <div class="panel-body">

                <?php // No tasks created for the chosen name
                if (empty(getTasks($_SESSION['current_user']))) {
                    echo "<div class='alert alert-info'>Woops.. Looks like there is no added tasks. </div>";
                } else {
                    echo "<table class='table table-borderless table-fit'>".
                        "<thead>".
                        "<tr>".
                        "<th>Status</th>".
                        "<th>Title</th>".
                        "<th>Action</th>".
                        "</tr>".
                        "</thead>".
                        "<tbody>";

                    foreach (getTasks($_SESSION['current_user']) as $task) {

                        echo"<tr>";

                        // Status badge
                        switch ($task->status) {
                            case "ongoing":
                                echo "<td><span class='label label-warning'>Ongoing</span></td>";
                            break;

                            case "finished":
                                echo "<td><span class='label label-success'>Finished</span></td>";
                            break;

                            default:
                                echo "<td><span class='label label-info'>Todo</span></td>";
                        }

                        echo
                            "<div class='container'>
                        <td>
                            <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto' 
                            title='". $task->title ."' 
                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                            </p>'>$task->title</a>
                        </td>
                      </div>";

                        echo
                            "<td><a class='btn btn-success btn-primary-spacing' name='completed' href='completed.php?id=".$task->id."'>
                            <span class='glyphicon glyphicon-check'></span> Completed
                        </a>
                        <a class='btn btn-info btn-primary-spacing' name='edit' href='edit.php?id=".$task->id."'>
                            <span class='glyphicon glyphicon-edit'></span> Edit
                        </a>
                        </td>
                        </tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }


                ?>


                <a type='submit' href="exit.php" name='exit' class='btn btn-danger'>
                    <span class='glyphicon glyphicon-log-out'></span> Exit
                </a>

                <a class="btn btn-success" name="newtask" href="newtask.php">
                    <span class='glyphicon glyphicon-plus'></span> New
                </a>
                </div>
        </div>
    </div>

    <!-- INCLUDE FOOTER -->
<?php include ('footer.html'); ?>