<?php
include '../view_contact.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information</title>
    <link rel="stylesheet" href="../view_contacts.css">
</head>

<body>

    <h2>My Phone Book App</h2>
    <h2>Contacts</h2>
    <form id="searchForm" method="GET">
        <input type="text" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Search</button>
        <button class="add_button"><a href="../contact/add_contact_html.php">Add Contact</a></button>
    </form>

    <?php
    foreach ($searchResults as $key => $person) {
        if ($person) {
            $imageURL = $person->getImage();
            echo '<div class="contact">';
            if ($imageURL) {
                echo '<p><img src="' . $imageURL . '" alt="Contact Image" style="width:100px;height:100px;"> ' . $person->getFirstName() . ' ' . $person->getLastName() . '</p>';
            } else {
                echo '<p>' . $person->getFirstName() . ' ' . $person->getLastName() . '</p>';
            }
            // Add Edit and Delete buttons
            echo '<button><a href="edit_contact.php?index=' . $key . '">Edit</a></button>';
            echo '<button><a href="delete_contact.php?index=' . $key . '" onclick="return confirm(\'Are you sure you want to delete this contact?\')">Delete</a></button>';
            echo '</div>';
        }
    }
    ?>

</body>

</html>