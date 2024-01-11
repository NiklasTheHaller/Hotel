<?php

include("inc/header.php");
require_once("config/db_config.php");

// Initialize variables for form validation and processing
$invalidUpload = "";
$invalidTitle = "";
$title = "";
$file = "";

global $title, $description, $newFileName, $author, $userId;

    // Validate and process the form for News Panel
    // Check if a file was uploaded
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {


        $file = $_FILES['thumbnail'];
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
                    $fileDestination = 'uploads/news/';
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
        $invalidUpload = "You must upload a thumbnail for the news article.";
    }

    // Get the title
    if (isset($_POST["newsTitle"])) {
        $title = trim($_POST["newsTitle"]);

        if (strlen($title) == 0) {
            $invalidTitle = "A news article must include a title!";
        }
    }

    // Get the news text
    $description = $_POST["newsText"];
    // Get the user id from the session
    $userId = $_SESSION["uid"];

    // Get the author from the session
    $author = $_SESSION["firstname"] . " " . $_SESSION["lastname"];

    // Insert the news article into the database
    $stmt = $conn->prepare("INSERT INTO news (title, newstext, imagepath, author, fk_user_id, newstimestamp) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->bind_param("ssssi", $title, $description, $newFileName, $author, $userId);

    if ($stmt->execute() === TRUE) {
        echo "News article created successfully";
    } else {
        echo "Error: " . $stmt->error;
        exit;
    }

?>