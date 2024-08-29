<?php
include 'create.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/create.css">
</head>

<body>
    <h2>New Contact</h2>
    <form method="POST" enctype="multipart/form-data">

        <label  >First Name:</label>
        <input type="text" required name="firstName" placeholder="First Name"><br>
        <label> Last Name:</label>
        <input type="text" required name="lastName" placeholder="Last Name"><br>
        <label>Phone No:</label>
        <input type="tel" required name="phoneNumber" placeholder="Phone Number"><br>
        <label>Company:</label>
        <input type="text" required name="company" placeholder="Company"><br>
        <label>Image</label>
        <input type="file" name="image" id="image" class="image" accept="image/*"><br>
        <button type="submit" name="submit">Save Contact</button><br>
        <button><a href="../views/index_html.php">
                View Contact
            </a></button>
    </form>
</body>

</html>