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

    <div class="task_page" style="font-family: Arial, serif; font-size: 16px">

        <div class="panel panel-default">
            <div class="container">
                <h3>New task</h3>
            </div>

            <form id="newtask_form" method="post" action="create.php">

                <div class="panel-body">
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control form-control input-lg" id="title" name="title" placeholder="Title" required>
                    </div>

                    <div class="form-group">
                        <label for="desc">Description:</label>
                        <input type="text" class="form-control form-control input-lg" id="description" name="description" placeholder="Description" required>
                    </div>

                    <div class="row">
                        <div class='col-sm-4'>
                            <div class="form-group">
                                <label for="datepicker">End date:</label>
                                <div class='input-group date' id='datepicker'>
                                    <input type='text' name="end_date" required placeholder="YYYY-MM-DD" class="form-control input-lg" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="todolist.php" name="cancel" class="btn btn-lg btn-warning">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </a>

                    <button type="submit" name="addtask" class="btn btn-lg btn-success">
                        <span class='glyphicon glyphicon-plus'></span> Add
                    </button>
                </div>
            </form>
        </div>

        <!-- INCLUDE FOOTER -->
<?php
include('footer.html');
?>