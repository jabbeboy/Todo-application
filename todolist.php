<?php
session_start();
require ('functions.php');
require ('session.php');

if (!$session->sessionIsSet()) {
	header("Location: index.php");
	exit();
}

$status = "finished";
?>

    <!-- INCLUDE HEADER -->
<?php include ('header.html'); ?>
    <div class="todo_page">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3><?php echo $_SESSION['current_user']; ?></h3>
            </div>

            <div class="panel-body">

				<?php // No tasks created for the chosen name ( LOOK at all tasks regardless of status)
				if (empty(getAllTasks($_SESSION['current_user']))) {
					echo "<div class='alert alert-info'>No task added..</div>";
				}
				else {

					if (!empty(getTasks($_SESSION['current_user'], 'ongoing'))) {

					// ONGOING TABLE
					echo "<table class='table table-borderless'>" .
						"<thead>" .
						"<tr>" .
						"<th></th>" .
						"<th></th>" .
						"<th></th>" .
						"</tr>" .
						"</thead>" .
						"<tbody>";
					foreach (getTasks($_SESSION['current_user'], 'ongoing') as $task) {
						echo "<tr>";

						echo "<td><span class='label label-warning'>Ongoing</span></td>";

						echo
							"<div class='container'>
                        <td>
                            <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto' 
                            title='" . $task->title . "' 
                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                            </p>'>$task->title</a>
                        </td>
                      </div>
                      
                        <td>
                           <a class='btn btn-default btn-primary-spacing' name='edit' href='edit.php?id=" . $task->id . "'>
                            <span class='glyphicon glyphicon-edit'></span> Edit
                        </a>
                        <a class='btn btn-success btn-primary-spacing' name='finished' href='action.php?action=finished&id=" . $task->id . "'>
                            <span class='glyphicon glyphicon-check'></span> Finished
                        </a>
                        </td>
                        
                       </td>
                       </tr><br>";
					}
					}
					// END ONGOING TABLE

					if (!empty(getTasks($_SESSION['current_user'], 'todo'))) {

						// TO-DO TABLE
						echo "</tbody></table>";

						echo "<table class='table table-borderless'>" .
							"<thead>" .
							"<tr>" .
							"<th></th>" .
							"<th></th>" .
							"<th></th>" .
							"</tr>" .
							"</thead>" .
							"<tbody>";
						foreach (getTasks($_SESSION['current_user'], 'todo') as $task) {
							echo "<tr>";
							// Status badge
							echo "<td><span class='label label-info'>Todo</span></td>";
							echo
								"<div class='container'>
                        <td>
                            <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto' 
                            title='" . $task->title . "' 
                            data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                            </p>'>$task->title</a>
                        </td>
                      </div>

							<td>
                                <a class='btn btn-info btn-primary-spacing' name='edit' href='action.php?action=start&id=".$task->id."'>
                                    <span class='glyphicon glyphicon-hand-left'></span> Start
                                </a>
                                
                                <a class='btn btn-default btn-primary-spacing' name='edit' href='edit.php?id=".$task->id."'>
                                    <span class='glyphicon glyphicon-edit'></span> Edit
                                </a>
                            </td>";

                        echo "</tr>";

							echo "</tbody>";
							echo "</table>";

						}
					}
					// END TO-DO TABLE


					// FINISHED TABLE
					echo "<table class='table table-borderless'>" .
						"<thead>" .
						"<tr>" .
						"<th></th>" .
						"<th></th>" .
						"<th></th>" .
						"</tr>" .
						"</thead>" .
						"<tbody>";
					foreach (getTasks($_SESSION['current_user'], 'finished') as $task) {
						echo "
                        <tr>";
						// Status badge
						echo "<td><span class='label label-success'>Finished</span></td>";
						echo
							"<div class='container'>
                        <td>
                            <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto' 
                                title='" . $task->title . "' 
                                data-content='<p>$task->description</p><p><b>Date added: </b>$task->added_date</p><p><b>End date: </b>$task->end_date</p>
                                </p>'>$task->title
                            </a>
                        </td></div>";
						echo "<td><a class='btn btn-default btn-primary-spacing' name='edit' href='edit.php?id=" . $task->id . "'>
                                    <span class='glyphicon glyphicon-edit'></span> Edit
                                  </a>
                              </td>
                        </tr>";
					}
					echo "</tbody>";
					echo "</table>";
					// END FINISHED TABLE
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