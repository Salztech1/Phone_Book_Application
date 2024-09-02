<?php
include '../create.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Phone-Book-App/styles/create.css">
    <title>New Contact</title>
</head>

<body>
    <h2>New Contact</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>First Name:</label>
        <input type="text" required name="firstName" placeholder="First Name"><br>

        <label>Last Name:</label>
        <input type="text" required name="lastName" placeholder="Last Name"><br>

        <label>Phone No:</label>
        <input type="tel" required name="phoneNumber" placeholder="Phone Number"><br>

        <label>Company:</label>
        <input type="text" required name="company" placeholder="Company"><br>

        <label>Image</label>
        <input type="file" name="image" id="image" class="image" accept="image/*" onchange="previewImage(event)"><br>

        <!-- Image preview container -->
        <div id="image-preview-container">
            <img id="image-preview" src="#" alt="Image Preview" style="display: none; width: 150px; height: auto; margin-top: 10px; border-radius: 8px;">
        </div>

        <button type="submit" name="submit">Save Contact</button><br>

        <button><a href="../views/index.php">View Contact</a></button>
    </form>

    <script>
        function previewImage(event) {
            var image = document.getElementById('image-preview');
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                    image.style.display = 'block'; // Show the image
                }
                reader.readAsDataURL(file);
            } else {
                image.src = '#';
                image.style.display = 'none'; // Hide the image if no file is selected
            }
        }
    </script>
</body>

</html>
 