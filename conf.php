<?php

/* Configuration Database connection */
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'todo');
define('DB_USER', 'root');
define('DB_PASS', '');

define('DSN', 'mysql:host='.DB_HOST.';dbname='.DB_NAME);

/* Error reporting , 1 = on, 0 = off */
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER["PHP_SELF"], 0, - (strlen($_SERVER["SCRIPT_FILENAME"]) -strlen(ROOT_DIR))));