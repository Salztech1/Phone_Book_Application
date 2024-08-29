<?php
session_start();
include 'classes/person.class.php';
include 'dbh-inc.php';

// Fetch contacts from the database
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

$persons = []; // Initialize an empty array to store contact objects


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $person = new Person($row['id'], $row['firstname'], $row['lastname'], $row['phonenumber'], $row['company'], $row['image']);
        $persons[] = $person;
    }
}



$searchResults = $persons;

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchResults = array_filter($persons, function ($person) use ($searchQuery) {
        return stripos($person->getFirstName(), $searchQuery) !== false || stripos($person->getLastName(), $searchQuery) !== false;
    });
}
?>