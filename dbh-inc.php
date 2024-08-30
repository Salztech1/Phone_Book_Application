<?php
define('DB_HOST', 'localhost');// or the IP address or hostname of your MySQL server
define('DB_USER', 'root'); // replace with your MySQL username
define('DB_PASS', '');// replace with your MySQL password
define('DB_NAME', 'phonebookapplication');// replace with the name of your MySQL database

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>