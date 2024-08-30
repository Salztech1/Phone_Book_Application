<?php 
    require_once 'ContactManager.php';
    require_once 'imageUpload.php';

    if(isset($_GET['index'])) {

        $index = $_GET['index'];

        $contactManager = new ContactManager();
        $contact = $contactManager->getContacts($index);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['firstName'];
            $lastname = $_POST['lastName'];
            $phonenumber = $_POST['phoneNumber'];
            $company = $_POST['company'];
            $image = '';

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = imageUpload();
            }

            $contactManager->editContact($index, $firstname, $lastname, $phonenumber, $company, $image);
        }
    } else {
        echo "No contact ID provided!";
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
    <form action="edit.php?index=<?php echo $index;?>" method="POST" enctype="multipart/form-data">

        <label  >First Name:</label>
        <input type="text" required name="firstName" placeholder="First Name" value="<?php echo htmlspecialchars($contact['firstname']);?>"><br>

        <label> Last Name:</label>
        <input type="text" required name="lastName" placeholder="Last Name" value="<?php echo htmlspecialchars($contact['lastname']);?>"><br>

        <label>Phone No:</label>
        <input type="tel" required name="phoneNumber" placeholder="Phone Number" value="<?php echo htmlspecialchars($contact['phonenumber']);?>"><br>

        <label>Company:</label>
        <input type="text" required name="company" placeholder="Company" value="<?php echo htmlspecialchars($contact['company']);?>"><br>

        <label>Image</label>
        <input type="file" name="image" id="image"  class="image"  accept="image/*"><br>

        <button type="submit" name="submit">Update Contact</button><br>
        <button><a href="views/index.php"> Cancel </a></button>
    </form>
</body>

</html>
</body>
</html>