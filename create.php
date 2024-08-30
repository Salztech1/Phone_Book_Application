<?php

require_once 'ContactManager.php';
require_once 'imageUpload.php';

session_start();
require_once '../classes/person.class.php';

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
                window.location.href = '../views/create_html.php'; // Replace with the actual URL of your form page
              </script>";
        exit();
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = imageUpload();
    }

    $contactManager = new ContactManager();
    $contactManager->createContact($firstname, $lastname, $number, $company, $image);
}
