<?php

require('session.php');

if (!$session->sessionIsSet()) {
    header("Location: index.php");
    exit();
}
?>
    <!-- INCLUDE HEADER -->
<?php include ('header.html'); ?>

    <div class="task_page">

        <div class="panel panel-default">
            <div class="panel-heading"><h3>New task</h3></div>

            <form id="newtask_form" method="post" action="actions/create.php">

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
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <label for="end_date">End date:</label>
                                <input type='text' id="end_date" name="end_date" class="form-control" value="2017-12-10" placeholder="YYYY-MM-DD"/>
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
<?php include ('footer.html'); ?>