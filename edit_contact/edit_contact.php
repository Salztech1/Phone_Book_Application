<?php
include '../view_contact.php';


// Define the function to update contact information
function updateContactInfo()
{

    include '../dbh-inc.php';

    $sql = "SELECT * FROM contacts";
    $result = $conn->query($sql);
    $persons = []; // Initialize an empty array to store contact objects


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $person = new Person($row['id'], $row['firstname'], $row['lastname'], $row['phonenumber'], $row['company'], $row['image']);
            $persons[] = $person;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['editIndex'])) {
            $index = $_POST['editIndex'];

            $persons[$index]->setFirstName($_POST['editFirstName']);
            $persons[$index]->setLastName($_POST['editLastName']);
            $persons[$index]->setNumber($_POST['editPhoneNumber']);
            $persons[$index]->setCompany($_POST['editCompany']);

            // Update the contact in the database
            $sql = "UPDATE contacts SET firstname = '{$persons[$index]->getFirstName()}', lastname = '{$persons[$index]->getLastName()}', phonenumber = '{$persons[$index]->getNumber()}', company = '{$persons[$index]->getCompany()}' WHERE id = '{$persons[$index]->getId()}'";
            $conn->query($sql);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form submission and update contact information
    $editIndex = $_POST['editIndex'];

    $newFirstName = $_POST['editFirstName'];
    $newLastName = $_POST['editLastName'];
    $newNumber = $_POST['editPhoneNumber'];
    $newCompany = $_POST['editCompany'];
    $newImage = $_FILES['editImage']['name']; // Use $_FILES for file uploads

    // Call the function to update contact information
    updateContactInfo($editIndex, $newFirstName, $newLastName, $newNumber, $newCompany, $newImage);

    // Redirect to view_contact.php to see the updated contact details
    header("Location: view_contact_html.php");
    exit;
}

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    if (isset($searchResults[$index])) {
        $contact = $searchResults[$index];

        $firstName = htmlspecialchars($contact->getFirstName());
        $lastName = htmlspecialchars($contact->getLastName());
        $number = htmlspecialchars($contact->getNumber());
        $company = htmlspecialchars($contact->getCompany());
        // Corrected variable assignment for the image URL
        $image = htmlspecialchars($contact->getImage());
    } else {
        // Handle invalid index
        echo "Invalid contact index.";
        exit;
    }
} else {
    // Handle missing index
    echo "Contact index is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
</head>

<body>
    <h2>Edit Contact</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="editIndex" value="<?php echo $index; ?>">
        <p>First Name: <input type="text" name="editFirstName" value="<?php echo $firstName; ?>"></p>
        <p>Last Name: <input type="text" name="editLastName" value="<?php echo $lastName; ?>"></p>
        <p>Phone No: <input type="tel" name="editPhoneNumber" value="<?php echo $number; ?>"></p>
        <p>Company: <input type="text" name="editCompany" value="<?php echo $company; ?>"></p>
        <!-- Use input type file for image uploads -->
        <p>Change Image: <input type="file" name="editImage" class="image"></p>
        <button type="submit">Save Changes</button>
    </form>
</body>

</html>