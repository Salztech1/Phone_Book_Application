<?php
session_start();
include 'classes/person.class.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phoneNumber']) && isset($_POST['company']) && isset($_FILES['image'])) {

    $target_dir = "Images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // To determine the file type
    
    // Check if image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $firstname = $_POST['firstName'];
            $lastname = $_POST['lastName'];
            $number = $_POST['phoneNumber'];
            $company = $_POST['company'];

            $person = new Person($firstname, $lastname, $number, $company, $target_file);

            $persons = isset($_SESSION['persons']) ? $_SESSION['persons'] : [];
            $persons[] = $person;

            $_SESSION['persons'] = $persons;

            header("Location: view_contact.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
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

