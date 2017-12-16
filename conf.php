<?php

/* Configuration Database connection */
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'todo');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_INIT_FILE',__DIR__.'/'.'init.sql');

define('DSN', 'mysql:host='.DB_HOST.';dbname='.DB_NAME);

/* Error reporting , 1 = on, 0 = off */
error_reporting(1);

define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER["PHP_SELF"], 0, - (strlen($_SERVER["SCRIPT_FILENAME"]) -strlen(ROOT_DIR))));