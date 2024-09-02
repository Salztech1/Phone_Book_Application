<?php 
    function imageUpload() { 

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../images/"; // Directory to store images
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if image file is a valid image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                echo "Error: File is not an image.";
                return;
            }

            // Check file size (e.g., max 2MB)
            if ($_FILES["image"]["size"] > 2000000) {
                echo "Error: Image file is too large.";
                return;
            }

            // Allow certain file formats
            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                echo "Error: Only JPG, JPEG, PNG & GIF files are allowed.";
                return;
            }

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "Image uploaded successfully to: " . $targetFile; 
            } else {
                echo "Error: There was an error uploading the image.";
                return;
            }
        } /*elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            echo "Error: Image upload failed with error code " . $_FILES['image']['error'];
            return;
        } else {
            // No new image uploaded; keep the old one
            echo "No new image uploaded, keeping the existing image.";
        } */
    
        return $targetFile;
    }
?>