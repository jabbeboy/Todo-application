<?php
session_start();

require ('functions.php');
require ('session.php');

// 2. Access by saved cookie
if (isset($_COOKIE['current_user'])) {

// Redirect to todo list
    header("Location: redirect.php");
}

?>

    <!-- INCLUDE HEADER -->
<?php include ('header.html'); ?>

        <div class="index_page">

            <?php
            // Connection could be established
            if (!checkConnection()) {
                echo '<div class="alert alert-danger alert-dissmissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Application is not available due to connection issues.
                Come back another time!
            </div>';
            }
            else {
                echo '<div class="panel panel-default">
        <div class="panel-heading"><h3>Choose name</h3></div>
        <div class="panel-body"><p>To use this application, enter your name, <br><i>Preferably your First Name followed by your the Last Name. :)</i></p>

        <form id="start_form" method="post" action="redirect.php">
            <div class="form-group row">
                <div class="col-xs-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                </div>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rememberme[]" value="remember"> Remember me</label>
                <p><i>(You will be automatically redirected to your to-do list.</i></p>
            </div>

            <button type="submit" name="choose" class="btn btn-default">
                <span class="glyphicon glyphicon-log-in"></span> Choose
            </button>
        </form></div>';
            }
            ?>
            </div>

    <!-- INCLUDE FOOTER -->
<?php include ('footer.html'); ?>