<?php
session_start();

require('functions.php');
require('session.php');


var_dump($_SESSION);
// 2. Access by saved cookie
if (isset($_COOKIE['current_user']) || isset($_SESSION['current_user'])) {

    // Redirect to todo list
    header("Location: redirect.php");
    exit();
}

?>

    <!-- INCLUDE HEADER -->
<?php
include('header.html');
?>
    <div class="index_page">
<?php
// Connection could be established
if (!checkConnection()) {
    header('Location: 404.php');
    exit();
} else {
    echo '<div class="panel panel-default">
        <div class="panel-heading">
            <h4>Choose name</h4>
        </div>
        <div class="panel-body"><p>To use this application, enter your full name</p>

        <form id="start_form" method="post" action="redirect.php">
            <div class="form-group row">
                <div class="col-xs-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Firstname Lastname" required>
                </div>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rememberme[]" value="remember"> Remember me</label>
                <p><i>(You will be automatically redirected to your to-do list as long as the cookie exist.</i></p>
            </div>

            <button type="submit" name="choose" class="btn btn-default">
                <span class="glyphicon glyphicon-log-in"></span> Choose
            </button>
        </form></div>';
}
?>