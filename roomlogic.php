<?php

include("inc/header.php");
require_once("config/db_config.php");

// Initialize variables for form validation and processing
$invalidUpload = "";
$invalidTitle = "";
$title = "";
$file = "";

global $title, $description, $newFileName, $price, $breakfast, $parking, $pets, $invalidUpload, $invalidTitle;

// Validate and process the form for Room Panel
// Check if a file was uploaded
if (isset($_FILES['roomThumbnail']) && $_FILES['roomThumbnail']['error'] == 0) {
    $file = $_FILES['roomThumbnail'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 3146000) { // file size in bytes
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'uploads/rooms/';
                move_uploaded_file($fileTmpName, $fileDestination . $fileNameNew);
                $newFileName = $fileDestination . $fileNameNew;
                // Read the uploaded file into an image resource
                $src = imagecreatefromstring(file_get_contents($newFileName));
                // Resize the image to 720x480
                $dst = imagescale($src, 720, 480);
                // Save the resized image back to disk
                if ($fileType == 'image/jpeg') {
                    imagejpeg($dst, $newFileName);
                } else {
                    imagepng($dst, $newFileName);
                }
                // Free up memory used by the image resources
                imagedestroy($src);
                imagedestroy($dst);
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
} else {
    $invalidUpload = "You must upload a thumbnail for the room.";
}

// Get the title for room
if (isset($_POST["roomTitle"])) {
    $title = trim($_POST["roomTitle"]);

    if (empty($title)) {
        $invalidTitle = "A room must include a title!";
    }
} else {
    $invalidTitle = "A room must include a title!";
}

// Get the description for room
if (isset($_POST["roomDescription"])) {
    $description = trim($_POST["roomDescription"]);

    if (empty($description)) {
        $invalidDescription = "A room must include a description!";
    }
} else {
    $invalidDescription = "A room must include a description!";
}

// Check if room price is numeric
if (isset($_POST["roomPrice"]) && $_POST["roomPrice"] !== "" && is_numeric($_POST["roomPrice"])) {
    $price = $_POST["roomPrice"];
} else {
    echo "Invalid price entered!";
    exit;
}

// Get other room details
$breakfast = $_POST["roomBreakfast"];
$parking = $_POST["roomParking"];
$pets = $_POST["roomPets"];

// Insert room information into the database if there are no validation errors
if (empty($invalidUpload) && empty($invalidTitle) && empty($invalidDescription)) {
    // Insert room information into the database
    $stmt = $conn->prepare("INSERT INTO rooms (title, imagepath, roomdescription, price, breakfast, parking, pets) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdddd", $title, $newFileName, $description, $price, $breakfast, $parking, $pets);

    if ($stmt->execute() === TRUE) {
        echo "Room created successfully";
    } else {
        echo "Error: " . $stmt->error;
        exit;
    }
}

?>