<?php
session_start();
require('functions.php');
require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['current_user'])) {

    // Get user details
    $user = getUser($session->getUserSession());

    // Get task info from database
    $task = array();
    $task = getTask($_GET['id'], $user['id']);
}
else {
    header("Location: todolist.php");
    exit();
}
?>
<?php
include('header.html');
?>
    <div class="edit_page">

        <div class="panel panel-default">
            <div class="container">
                <h3>Edit</h3>
            </div>

            <form id="edit_task_form" method="post" action="action.php">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="id">Task id:</label>
                            <input type="text" class="form-control input-lg" readonly="readonly" id="id" name="id" value="<?php
                            echo $task->id;
                            ?>" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control input-lg" id="title" name="title" value="<?php
                            echo $task->title;
                            ?>" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control input-lg" id="description" name="description" value="<?php
                            echo $task->description;
                            ?>" required>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class='col-sm-4'>
                            <div class="form-group">
                                <label for="datepicker_edit">End date:</label>
                                <div class='input-group date' id='datepicker_edit'>
                                    <input type='text' name="end_date" required class="form-control input-lg" placeholder="YYYY-MM-DD">

                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="status">Status:</label>
                            <select class="form-control form-control input-lg"  name="status">
                                <option value="ongoing">Ongoing</option>
                                <option value="todo">Todo</option>
                                <option value="finished">Finished</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <a class="btn btn-lg btn-danger" href='<?php
                    echo "action.php?action=delete&id=" . $task->id;
                    ?>' name="delete">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </a>

                    <a class="btn btn-lg btn-warning" href="todolist.php" name="cancel" >
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </a>

                    <button class="btn btn-lg btn-success" type="submit" name="save" >
                        <span class="glyphicon glyphicon-plus"></span> Save
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php
include('footer.html');
?>