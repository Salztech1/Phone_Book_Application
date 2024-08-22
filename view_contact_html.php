<?php
include 'view_contact.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information</title>
    <link rel="stylesheet" href="view_contact.css">
</head>

<body>

<h2>My Phone Book App</h2>
<h2>Contacts</h2>
<form id="searchForm" method="GET">
    <input type="text" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    <button type="submit">Search</button>
    <button class="add_button"><a href="add_contact_html.php">Add Contact</a></button>
</form>

<?php
foreach ($searchResults as $key => $person) {
    echo '<p><a href="#" onclick="togglePersonInfo(' . $key . ');">' . $person->getFirstName() . ' ' . $person->getLastName() . '</a></p>';
    
    echo '<div class="personInfo" id="personInfo' . $key . '">';
    echo '<form method="POST">';
   
    echo '<img src="' . $person->getImage() . '" alt="Person Image">';

    echo '<input type="hidden" name="editIndex" value="' . $key . '">';
    echo '<p>First Name: <input type="text" name="editFirstName" value="' . $person->getFirstName() . '"></p>';

    echo '<p>Last Name: <input type="text" name="editLastName" value="' . $person->getLastName() . '"></p>';
    echo '<p>Phone No: <input type="text" name="editPhoneNumber" value="' . $person->getNumber() . '"></p>';
    echo '<p>Company: <input type="text" name="editCompany" value="' . $person->getCompany() . '"></p>';
    echo '<span><button type="submit">Save Changes</button></span>';

    echo '</form>';
    echo '<span><a href="?delete=' . $key . '">Delete</a></span>';
    echo '</div>';
}
?>

<script>
    function togglePersonInfo(index) {
        const personInfo = document.getElementById('personInfo' + index);
        if (personInfo.style.display === 'none') {
            personInfo.style.display = 'block';
        } else {
            personInfo.style.display = 'none';
        }
    }
</script>
</body>

</html>