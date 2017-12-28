<?php

define('DB_HOST', 'localhost'); // database host address
define('DB_PORT', '3306'); // database port
define('DB_NAME', 'todo'); // database name
define('DB_USER', 'root'); // database username
define('DB_PASS', 'root'); // database password
define('DSN', 'mysql:host='.DB_HOST.';dbname='.DB_NAME);

/* Error reporting, 1 = ON => Development, 0 = OFF => Production */
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

/* Not used */
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER["PHP_SELF"], 0, - (strlen($_SERVER["SCRIPT_FILENAME"]) -strlen(ROOT_DIR))));