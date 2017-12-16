<?php

require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}
?>
    <!-- INCLUDE HEADER -->
<?php
include('header.html');
?>

    <div class="task_page">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>New task</h4>
            </div>

            <form id="newtask_form" method="post" action="create.php">

                <div class="panel-body">
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Title" required>
                    </div>

                    <div class="form-group">
                        <label for="desc">Description:</label>
                        <input type="text" class="form-control form-control-lg" id="description" name="description" placeholder="Description" required>
                    </div>

                    <div class="row">
                        <div class='col-sm-3'>
                            <div class="form-group">
                                <label for="datepicker">End date:</label>
                                <div class='input-group date' id='datepicker'>
                                    <input type='text' name="end_date" required placeholder="2015-12-15" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="todolist.php" name="cancel" class="btn btn-warning">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </a>

                    <button type="submit" name="addtask" class="btn btn-success">
                        <span class='glyphicon glyphicon-plus'></span> Add
                    </button>
                </div>
            </form>
        </div>

        <!-- INCLUDE FOOTER -->
<?php
include('footer.html');
?>