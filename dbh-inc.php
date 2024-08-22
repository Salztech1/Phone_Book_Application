<?php


$host = 'localhost'; // or the IP address or hostname of your MySQL server
$user = 'root'; // replace with your MySQL username
$password = ''; // replace with your MySQL password
$database = 'phonebookapplication'; // replace with the name of your MySQL database

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//data src name
// $dsn = "mysql:host=localhost;dbname=phonebookapplication";
// $dbusername = "root";
// $dbpassword = "";


// $conn = new mysqli($dsn, $dbusername, $dbpassword);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// try {
// $pdo = new PDO($dsn, $dbusername, $dbpassword ); //pdo = php data object
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// } catch (PDOException $e) {
//     echo "Connection Failed: " . $e->getMessage();
    
// }