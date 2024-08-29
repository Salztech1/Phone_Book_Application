<?php

session_start();
include '../classes/person.class.php';
include '../dbh-inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phoneNumber']) && isset($_POST['company']) && isset($_FILES['image'])) {

    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $number = $_POST['phoneNumber'];
    $company = $_POST['company'];

    // Server-side validation for phone number: Check if it contains only digits
    if (!preg_match('/^[+]?[0-9\s\-\(\)]+$/', $number)) {
        // Use JavaScript alert to show the message and redirect back to the form
        echo "<script>
                alert('Invalid phone number. Please enter a valid phone number.');
                window.location.href = 'add_contact_html.php'; // Replace with the actual URL of your form page
              </script>";
        exit();
    }

    // Set the target directory and file path
    $target_dir = "../Images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit();
    }

    // Debugging: Check if directory exists and is writable
    // if (!is_dir($target_dir)) {
    //     echo "Directory does not exist: $target_dir<br>";
    //     exit();
    // }

    // if (!is_writable($target_dir)) {
    //     echo "Directory is not writable: $target_dir<br>";
    //     exit();
    // }

    //echo "Attempting to move file to: $target_file<br>";

    // Try to move the uploaded file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "File uploaded successfully to $target_file<br>";

        // Insert into the database
        $sql = "INSERT INTO contacts (firstname, lastname, phonenumber, company, image) VALUES ('$firstname', '$lastname', '$number', '$company', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../edit_contact/view_contact_html.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file. Error details: " . print_r(error_get_last(), true) . "<br>";
    }

    // Close the database connection
    $conn->close();
}
