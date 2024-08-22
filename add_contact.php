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
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //determine the file
    
    // Check if image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);


    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO contacts (firstname, lastname, phonenumber, company, image) VALUES ('$firstname', '$lastname', '$number', '$company', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            header("Location: view_contact.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $conn->close();
}
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_contact.css">
</head>

<body>
    <h2>New Contact</h2>
    <form method="POST" enctype="multipart/form-data">

        <label>First Name:</label>
        <input type="text" required name="firstName" placeholder="First Name"><br>
        <label> Last Name:</label>
        <input type="text" required name="lastName" placeholder="Last Name"><br>
        <label>Phone No:</label>
        <input type="text" required name="phoneNumber" placeholder="Phone Number"><br>
        <label>Company:</label>
        <input type="text" required name="company" placeholder="Company"><br>
        <label>Image</label>
        <input type="file" name="image" id="image" ><br>
        <button type="submit" name="submit">Save Contact</button><br>
        <button><a href="view_contact.php">
                View Contact
            </a></button>
    </form>
</body>

</html>
