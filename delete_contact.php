<?php
include '../dbh-inc.php'; // Make sure this path is correct

if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    $contactId = $persons[$index]->getId();

    // Delete the contact from the database
    $sql = "DELETE FROM contacts WHERE id = '$contactId'";
    $conn->query($sql);

    unset($persons[$index]);

} else {
    echo "Contact ID is missing.";
}

// Redirect back to the contacts view
header("Location: view_contact_html.php");
exit;
