<?php
$target_dir = "./";  // Gunakan direktori saat ini
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$error_messages = array();

// Debugging info
echo "Target File: $target_file<br>";

// Check if directory exists and has correct permissions
if (!is_dir($target_dir)) {
    echo "Target directory does not exist.";
    exit;
}

// Check if file is uploaded
if (isset($_FILES["file"])) {
    if ($_FILES["file"]["error"] != UPLOAD_ERR_OK) {
        $error_messages[] = "Error: " . $_FILES["file"]["error"];
    } else {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["file"]["name"]). " has been uploaded.";
        } else {
            $error_messages[] = "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $error_messages[] = "No file was uploaded.";
}

// Display error messages if any
if (!empty($error_messages)) {
    foreach ($error_messages as $message) {
        echo "<br>" . $message;
    }
    // Log errors for debugging
    error_log("Upload Error: " . print_r($_FILES, true));
}
?>

