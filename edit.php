<?php 
require_once 'ContactManager.php';
require_once 'imageUpload.php';

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $contactManager = new ContactManager();
    $contact = $contactManager->getContacts($index);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $phonenumber = $_POST['phoneNumber'];
        $company = $_POST['company'];

        // Check if a new image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = imageUpload();
        } else {
            // Use existing image if no new one is uploaded
            $image = isset($contact['images']) ? $contact['images'] : '';
        }

        // Update the contact
        $contactManager->editContact($index, $firstname, $lastname, $phonenumber, $company, $image);
    }
} else {
    echo "No contact ID provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Phone-Book-App/styles/create.css">
    <title>Edit Contact</title>
</head>
<body>
<h2>Edit Contact</h2>
<form action="edit.php?index=<?php echo $index; ?>" method="POST" enctype="multipart/form-data">
    <?php
    if ($contact) {
        $imageURL = isset($contact['images']) ? $contact['images'] : ''; 
        $personId = $contact['id'];
        echo '<div class="contact" style="display:flex; text-align: center; justify-content: center;">';
        echo '<div>';
        if (!empty($imageURL)) {
            echo '<p><img src="' . htmlspecialchars($imageURL) . '" alt="Contact Image" style="width:150px; height:auto; border-radius:8px;"></p>';
        } else {
            echo '<p>No image available</p>';
        }
        echo '</div>';
        echo '</div>';
    }
    ?>

    <label>First Name:</label>
    <input type="text" required name="firstName" placeholder="First Name" value="<?php echo htmlspecialchars($contact['firstname']); ?>"><br>

    <label>Last Name:</label>
    <input type="text" required name="lastName" placeholder="Last Name" value="<?php echo htmlspecialchars($contact['lastname']); ?>"><br>

    <label>Phone No:</label>
    <input type="tel" required name="phoneNumber" placeholder="Phone Number" value="<?php echo htmlspecialchars($contact['phonenumber']); ?>"><br>

    <label>Company:</label>
    <input type="text" required name="company" placeholder="Company" value="<?php echo htmlspecialchars($contact['company']); ?>"><br>

    <label>Image</label>
    <input type="file" name="image" id="image" class="image" accept="image/*" onchange="previewImage(event)"><br>

    <!-- Image preview -->
    <div id="image-preview-container">
        <img id="image-preview" src="#" alt="Image Preview" style="display: none; width: 150px; height: auto; margin-top: 10px; border-radius: 8px;">
    </div>

    <button type="submit" name="submit">Update Contact</button><br>
    <button><a href="views/index.php">Cancel</a></button>
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
