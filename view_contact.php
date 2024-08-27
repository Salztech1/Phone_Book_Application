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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['editIndex'])) {
        $index = $_POST['editIndex'];

        $persons[$index]->setFirstName($_POST['editFirstName']);
        $persons[$index]->setLastName($_POST['editLastName']);
        $persons[$index]->setNumber($_POST['editPhoneNumber']);
        $persons[$index]->setCompany($_POST['editCompany']);

        // Update the contact in the database
        $sql = "UPDATE contacts SET firstname = '{$persons[$index]->getFirstName()}', lastname = '{$persons[$index]->getLastName()}', phonenumber = '{$persons[$index]->getNumber()}', company = '{$persons[$index]->getCompany()}' WHERE id = '{$persons[$index]->getId()}'";
        $conn->query($sql);
    }
}

if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    $contactId = $persons[$index]->getId();

    // Delete the contact from the database
    $sql = "DELETE FROM contacts WHERE id = '$contactId'";
    $conn->query($sql);

    unset($persons[$index]);
}

$searchResults = $persons;

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchResults = array_filter($persons, function ($person) use ($searchQuery) {
        return stripos($person->getFirstName(), $searchQuery) !== false || stripos($person->getLastName(), $searchQuery) !== false;
    });
}
?>