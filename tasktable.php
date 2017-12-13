<!-- Task table -->
<?php
session_start();
require ('functions.php');
require ('session.php');


if (empty(getTasks($_SESSION['current_user']))) {
	echo "<div class='alert alert-info'>No tasks added..</div>";
}
else {
	echo "<b>Ongoing</b>
<table class='table table-borderless'>
    <thead>
    <tr>
        <th>Status</th>
        <th>Title</th>
        <th>Action</th>
    </tr>
    </thead>";

	var_dump(getTasks($_SESSION['current_user']));

	foreach (getTasks($_SESSION['current_user']) as $task) {

		echo "<tbody>
    <tr>
        <div class='container'>
            <td>
                <a href='' id='task_popover' data-toggle='popover' data-trigger='hover' data-placement='auto'
                   title='<?php $task->title ?>'
                   data-content='
				   <p>$task->description</p>
				   <p><b>Date added: </b>$task->added_date</p>
				   <p><b>End date: </b>$task->end_date</p>
                   </p>'>$task->title</a>
            </td>
        </div>

        <td><a class='btn btn-success btn-primary-spacing' name='completed' href='completed.php?id=" . $task->id . "'>
                <span class='glyphicon glyphicon-check'></span> Finished
            </a>
            <a class='btn btn-info btn-primary-spacing' name='edit' href='edit.php?id=" . $task->id . "'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </a>
        </td>
    </tr>
    </tbody>
</table>";
	}
}

?>

<a type='submit' href="exit.php" name='exit' class='btn btn-danger'>
    <span class='glyphicon glyphicon-log-out'></span> Exit
</a>

<a class="btn btn-success" name="newtask" href="newtask.php">
    <span class='glyphicon glyphicon-plus'></span> New
</a>
