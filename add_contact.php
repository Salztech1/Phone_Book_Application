<?php
session_start();
include 'classes/person.class.php';
include 'dbh-inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phoneNumber']) && isset($_POST['company']) && isset($_FILES['image'])) {


    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $number = $_POST['phoneNumber'];
    $company = $_POST['company'];

    $target_dir = "Images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]); //basename is to retrive the basename of the uploaded file from the file arrey
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //determine the file

    // Check if image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);


    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO contacts (firstname, lastname, phonenumber, company, image) VALUES ('$firstname', '$lastname', '$number', '$company', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            header("Location: view_contact_html.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    //Database connection closes
    $conn->close();
}
