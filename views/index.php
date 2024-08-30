<?php
include '../app.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>

    <h2>My Phone Book App</h2>
    <h2 >Contacts</h2>
    <form id="searchForm" method="GET">
        <input type="text" name="search" placeholder="Search Contact..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Search</button>
        <button class="add_button"><a href="../views/create_html.php">Add Contact</a></button>
    </form>

    <?php
foreach ($searchResults as $key => $person) {
    if ($person) {
        $imageURL = $person->getImage();
        $personId = $person->getId();
        echo '<div class="contact" style="display:flex; text-align: center; justify-content: center;">';
        echo '<div>';
        if ($imageURL) {
            echo '<p><img src="' . $imageURL . '" alt="Contact Image" style="width:50px; height:auto; border-radius:100px;"> ' . $person->getFirstName() . ' ' . $person->getLastName() . '</p>';
        } else {
            echo '<p>' . $person->getFirstName() . ' ' . $person->getLastName() . '</p>';
        }
        echo '</div>';
        
        // Add Edit and Delete buttons
        echo '<div style="margin-top: 30px; margin-left: 10px; display:flex;">';

        // Edit button
        echo '<div>';
        echo '<button style="border-radius:5px; border:none; background: white;"><a href="../edit.php?index=' . $personId . '" style="color: #903AFF; text-decoration: none;"><b>View</b></a></button>';
        echo '</div>';

        // Delete button
        echo '<div style="margin-left: 10px;">';
        echo '<button style="background: white; border:none; border-radius:5px;">';
        echo '<a href="../delete.php?delete=' . $personId . '" onclick="return confirm(\'Are you sure you want to delete this contact?\')" style="color: red; text-decoration: none;"><b>Delete<b/></a>';
        echo '</button>';
        echo '</div>';

        echo '</div>';
        echo '</div>';
        
    }
}
?>


</body>

</html>