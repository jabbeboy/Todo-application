<?php
require ('../functions.php');
require ('../session.php');

if (!$session->sessionIsSet()) {
    header("Location: ../index.php");
    exit();
}

$task = array();

if (isset($_SESSION['current_user'])) {

    if (isset($_POST['save'])) {
        $task = [
            'id' => $_GET['id'],
            'title' => htmlspecialchars(strip_tags($_POST['title'], ENT_QUOTES)),
            'description' => nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8')),
            'author' => $_SESSION['current_user'],
            'added_date' => date("Y-m-d"),
            'end_date' => $_POST['end_date'],
            'finished' => $_POST['status']
        ];
        updateTask($task);
        header("Location: ../todolist.php");
    }

    // Get task info from database
    $task = array();
    $task = getTask($_GET['id'], $_SESSION['current_user']);
}
?>

    <!-- INCLUDE HEADER -->
<?php include('../header.html'); ?>

    <div class="edit_page">

        <div class="panel panel-default">
            <div class="panel-heading"><h3>Edit</h3></div>

            <form id="edit_task_form" method="post" action="">
                <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $task->title; ?>" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?php echo $task->description; ?>" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class='col-sm-2'>
                        <div class="form-group">
                            <label for="end_date">End date:</label>
                            <input type='text' id="end_date" name="end_date" class="form-control" value="<?php echo $task->end_date; ?>" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <label for="status">Status: (select one):</label>
                        <select class="form-control form-control-lg" name="status">
                            <option value="0" >0 - Ongoing</option>
                            <option value="1" >1 - Finished</option>
                        </select>
                    </div>
                </div>

                <br>
                <a class="btn btn-danger" href='<?php echo "delete.php?id=" . $task->id; ?>' name="delete">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </a>

                <a class="btn btn-warning" href="../todolist.php" name="cancel" >
                    <span class="glyphicon glyphicon-remove"></span> Cancel
                </a>

                <button type="submit" name="save" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span> Save
                </button>
                </div>
            </form>
        </div>
    </div>

    <!-- INCLUDE FOOTER -->
<?php include('../footer.html'); ?>