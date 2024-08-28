<?php
include 'dbh-inc.php'; // Ensure this path is correct

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    // if no contact id is sent
    if (empty($id)) {
        echo "Contact ID is missing.";
    } else {
        $sql_query = "DELETE FROM contacts WHERE id = $id";

        try {
            // Execute the query using mysqli_query()
            $response = mysqli_query($conn, $sql_query);

            // Check if the deletion was successful
            if ($response) {
                // Redirect to view_contact_html.php
                header("Location: edit_contact/view_contact_html.php");
                exit;
            } else {
                echo "Error: Unable to delete contact.";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Unable to delete contact: " . $e->getMessage() . "<br>";
            echo "Go back and try again.";
        }

        $conn = null;
    }
} 
$conn->close(); // Close the database connection