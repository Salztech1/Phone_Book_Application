<?php


$host = 'localhost'; // or the IP address or hostname of your MySQL server
$user = 'root'; // replace with your MySQL username
$password = ''; // replace with your MySQL password
$database = 'phonebookapplication'; // replace with the name of your MySQL database

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

