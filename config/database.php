<?php

define('BASE_PATH', '/online-library-system/');


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'library_system_db');


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if ($conn->connect_error) {
    die("ERROR: Could not connect. " . $conn->connect_error);
}


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>