<?php 
    require_once 'classes/person.class.php';
    require_once 'dbh-inc.php';

    class ContactManager {
        private $conn;

        public function __construct() {
            $this->connect_Database();
        }

        public function connect_Database() {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->conn->connect_error) {
                die("Connection Failed!" .  $this->conn->connect_error);
            }
        }

        public function getContacts(int $index) {
            $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE id = ?");
            $stmt->bind_param('i', $index);
            $stmt->execute();

            $result = $stmt->get_result();
            $contact = $result->fetch_assoc();
            $stmt->close();

            return $contact;
        }

        public function createContact(string $firstname, string $lastname, string $number, string $company, string $target_file) {
            $stmt = $this->conn->prepare("INSERT INTO contacts (firstname, lastname, phonenumber, company, images) VALUES (?, ?, ?, ?, ?)"); // Initializing the prepared statement.
            $stmt->bind_param('sssss', $firstname, $lastname, $number, $company, $target_file); // Binding the parameters to the prepared statement. 

            // Checking if the prepared statement is executed or not
            if (!$stmt->execute()) {
                die("Contact Not Created!" . $stmt->error); // We use the die statement to create a custom error message and to stop the execution of the script.
            } else {
                echo "Contact created Successfully!";
            }
            $stmt->close();
        }

        public function editContact(int $id, string $firstname, string $lastname, string $number, string $company,  $image) {
            if (empty($target_file)) {
                $stmt = $this->conn->prepare("SELECT images FROM contacts  WHERE id = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $image = $row['images'];
            }

            //Preparing the update statement
            $stmt = $this->conn->prepare("UPDATE contacts SET firstname = ?, lastname = ?, phonenumber = ?, company = ?, images = ? WHERE id = ?");
            $stmt->bind_param('sssssi', $firstname, $lastname, $number, $company, $image, $id);

            if ($stmt->execute()) {
                header("Location: views/index.php");
                exit;
            } else {
                error_log("Failed to edit contact: ". $stmt->error);
                echo "Contact not Edited";
            }

            $stmt->close();
        }

        public function __destruct()
        {
            $this->conn->close();
        }
    }
?>