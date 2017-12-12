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
            <?php

            // No tasks created for the chosen name
            if (empty(getTasks($_SESSION['current_user']))) {
                echo "<div class='alert alert-info'>
                    Woops.. Looks like there is no added tasks.
                  </div>";
            } else {
                echo "<table class='table table-borderless table-condensed table-hover'>"
                    ."<thead>"
                    ."<tr>"
                    ."<th>Status</th>"
                    ."<th>Title</th>"
                    ."<th>Action</th>"
                    ."</tr>"
                    ."</thead><tbody>";

                foreach (getTasks($_SESSION['current_user']) as $task) {
                    echo "<tr>";

                    if ($task->finished == 1) {
                        echo "<td><span class='label label-success'>Finished</span></td>";
                    }
                    else {
                        echo "<td><span class='label label-warning'>Ongoing</span></td>";
                    }

                    echo "<div class='container'>
                        <td>
                            <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto' title='". $task->title ."' 
                            data-content='
                            <p>$task->description</p>
                            <p><b>Added: </b>$task->added_date</p>
                            <p><b>End date: </b>$task->end_date</p>
                            </p>'>$task->title</a>
                        </td>
                      </div>";

                    echo "<hr />";

                    echo "<td><a class='btn btn-success btn-primary-spacing' name='completed' href='actions/completed.php?id=".$task->id."'>
                            <span class='glyphicon glyphicon-check'></span> Finished
                        </a>
                        <a class='btn btn-info btn-primary-spacing' name='edit' href='actions/edit.php?id=".$task->id."'>
                            <span class='glyphicon glyphicon-edit'></span> Edit
                        </a></td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
            ?>

            <a type='submit' href="actions/exit.php" name='exit' class='btn btn-danger'>
                <span class='glyphicon glyphicon-log-out'></span> Exit
            </a>

            <a class="btn btn-success" name="newtask" href="newtask.php">
                <span class='glyphicon glyphicon-plus'></span> New
            </a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("[data-toggle=popover]").each(function(i, obj) {
                $(this).popover({
                    html: true,
                    content: function() {
                        var id = $(this).attr('id')
                        return $('#popover-content-' + id).html();
                    }
                });
            });
        });
    </script>

    <!-- INCLUDE FOOTER -->
<?php include ('footer.html'); ?>