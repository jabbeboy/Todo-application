<?php
session_start();

require('functions.php');
require('session.php');

// 2. Access by saved cookie
if (isset($_COOKIE['current_user']) || isset($_SESSION['current_user'])) {
    header("Location: redirect.php");
    exit();
}
?>
    <!-- INCLUDE HEADER -->
<?php include('header.html'); ?>

<?php
//Only show if connection is active.
if (checkConnection()) {
    echo '<div class="index_page" style="font-family: Arial, serif; font-size: 16px">
    <div class="panel panel-default">
        <div class="container">
            <h3>Choose name</h3>

        </div>
        <div class="panel-body">
            <p>To use this application, enter your full name</p>

        <form id="start_form" method="post" action="redirect.php">

            <div class="row">
                <div class="col-sm-4">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control input-lg" id="name" name="name" placeholder="John Doe" required>
                </div>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rememberme[]" value="remember"> Remember me</label>
            </div>

            <button type="submit" name="choose" class="btn btn-success btn-lg">
                <span class="glyphicon glyphicon-log-in"></span> Choose
            </button>
        </form></div>';

    include ("footer.html");
}
else {
    include ("alert-danger-popup.php");
    exit();
}
 ?>