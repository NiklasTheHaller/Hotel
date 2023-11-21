<?php
$pageTitle = "Hotel Mama | Account";
$metaDesc = "Your account page";
include("inc/header.php");

// Function to determine if the form is in "edit" mode
function isEditMode()
{
    return isset($_GET["edit"]) && $_GET["edit"] == "true";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["firstname"]) && isset($_POST["lastname"])) {
        // Update session variables with the submitted values
        $_SESSION["firstname"] = $_POST["firstname"];
        $_SESSION["lastname"] = $_POST["lastname"];

        // Print the session data
        print_r($_SESSION);
    } else {
        echo "Form data not set correctly.";
    }

    // Redirect back to the non-editable form after processing the submission
    header("Location: ?edit=false");
    exit();




     // Check if a file was uploaded
     if (isset($_FILES['profilepicture']) && $_FILES['profilepicture']['error'] == 0) {
        // Get the uploaded file
        $file = $_FILES['profilepicture'];
        // Get the size of the uploaded file
        $fileSize = $_FILES['profilepicture']['size'];
        // Get the temporary location of the uploaded file on the server
        $fileTmpName = $_FILES['profilepicture']['tmp_name'];
        // Get the type of the uploaded file
        $fileType = $_FILES['profilepicture']['type'];

        // Check if the uploaded file is a jpeg or png
        if ($fileType == 'image/jpeg' || $fileType == 'image/png') {
            // Check if the size of the uploaded file is between 0 and 3 MB
            if ($fileSize > 0 && $fileSize < 3146000) {
                // Create a new file name for the uploaded file - name will be used as primary key in db?
                $newFileName = 'img\profile-picture/' . uniqid('', true) . '.' . ($fileType == 'image/jpeg' ? 'jpg' : 'png');
                // Move the uploaded file from its temporary location to the 'newsuploads' directory
                if (!file_exists('img\profile-picture')) {
                    mkdir('img\profile-picture', 0777, true);
                }
                move_uploaded_file($fileTmpName, $newFileName);

                // Read the uploaded file into an image resource
                $src = imagecreatefromstring(file_get_contents($newFileName));
                // Resize the image to 320x320
                $dst = imagescale($src, 320, 320);
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
                $invalidUpload = "File size must be between 0 and 3 MB.";
            }
        } else {
            $invalidUpload = "Invalid file type. Only JPEG and PNG files are allowed.";
        }
    } else {
        $invalidUpload = "You must upload a profilepicture.";
    }
}


?>

<main>
    <div class="container">
        <div class="mb-3 profile-box mt-2">
            <h3>Profile</h3>
            <form action="" method="post">

                <fieldset <?php echo (isEditMode() ? '' : 'readonly'); ?>>

                    <div class="row">
                        <div class="col mb-3">
                            <legend>First Name</legend>
                            <label for="firstname" class="form-label"></label>
                            <input type="text" id="firstname" name="firstname" class="form-control"
                                value="<?php echo isset($_SESSION["firstname"]) ? $_SESSION["firstname"] : '' ?>" <?php echo (isEditMode() ? '' : 'readonly'); ?>>
                        </div>


                        <div class="col mb-3">
                            <legend>Last Name</legend>
                            <label for="lastname" class="form-label"></label>
                            <input type="text" id="lastname" name="lastname" class="form-control"
                                value="<?php echo isset($_SESSION["lastname"]) ? $_SESSION["lastname"] : '' ?>" <?php echo (isEditMode() ? '' : 'readonly'); ?>>
                        </div>
                    </div>

                    <?php if (isEditMode()): ?>
                        <button class="btn btn-outline-success" type="submit">Done</button>
                    <?php else: ?>
                        <a class="btn btn-outline-info" href="?edit=true">Edit</a>
                    <?php endif; ?>
                </fieldset>

            </form>
            <br>
            <div class="">
                <div class="mb-3 mt-3">
                    <form enctype="multipart/form-data" method="post">
                        <label class="form-label" for="profilepicture">
                            <legend>Profile Picture</legend>
                        </label>
                        <input type="file" class="form-control" accept="image/jpeg,image/png" id="profilepicture"
                            name="profilepicture">
                        <button class="btn btn-primary mt-3" type="submit">Update Profile</button>
                    </form>
                </div>
            </div>
            <!-- Display the profile picture dynamically 
            <img src="<?php echo isset($_SESSION["profile_picture"]) ? $_SESSION["profile_picture"] : 'img/profile-picture/default.png'; ?>"
                alt="Profile Picture" width="320" height="320" class="rounded-circle">
                -->
        </div>
    </div>
</main>

<?php
include("inc/footer.php")
    ?>