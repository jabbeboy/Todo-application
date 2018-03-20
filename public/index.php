<?php
session_start();


// Define application ROOT directory
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'resources' . DIRECTORY_SEPARATOR);

// Load config
require APP . 'conf/conf.php';

// 2. Access by saved cookie
if (isset($_COOKIE['current_user']) || isset($_SESSION['current_user'])) {
    header("Location: redirect.php");
    exit();
}
?>

<?php include(APP . '/templates/header.html'); ?>

    <div class="index_page" style="font-family: Arial, serif; font-size: 16px">

<?php
//Only show if connection is active.
if (checkConnection()) {
    echo '
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
}
else {
    include (APP . "/templates/alert-danger-popup.php");
    exit();
}

include (APP. "templates/footer.html");
?>


