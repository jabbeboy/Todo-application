<?php
session_start();
require('../session.php');

if (!$session->sessionIsSet()) {
    header("Location: ../index.php");
    exit();
}

$session->unsetCurrentUser();
header('Location: ../index.php');

