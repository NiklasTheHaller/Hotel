<?php
$pageTitle = "Hotel Mama | News";
$metaDesc = "Hotel Mama's newspage";
include("inc/header.php");

$invalidUpload = "";
$invalidTitle = "";
$title = "";
$file = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        // Get the uploaded file
        $file = $_FILES['thumbnail'];
        // Get the size of the uploaded file
        $fileSize = $_FILES['thumbnail']['size'];
        // Get the temporary location of the uploaded file on the server
        $fileTmpName = $_FILES['thumbnail']['tmp_name'];
        // Get the type of the uploaded file
        $fileType = $_FILES['thumbnail']['type'];

        // Check if the uploaded file is a jpeg or png
        if ($fileType == 'image/jpeg' || $fileType == 'image/png') {
            // Check if the size of the uploaded file is between 0 and 3 MB
            if ($fileSize > 0 && $fileSize < 3146000) {
                // Create a new file name for the uploaded file - name will be used as primary key in db?
                $newFileName = 'newsuploads/' . uniqid('', true) . '.' . ($fileType == 'image/jpeg' ? 'jpg' : 'png');
                // Move the uploaded file from its temporary location to the 'newsuploads' directory
                if (!file_exists('newsuploads')) {
                    mkdir('newsuploads', 0777, true);
                }
                move_uploaded_file($fileTmpName, $newFileName);

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
                $invalidUpload = "File size must be between 0 and 3 MB.";
            }
        } else {
            $invalidUpload = "Invalid file type. Only JPEG and PNG files are allowed.";
        }
    } else {
        $invalidUpload = "You must upload a thumbnail.";
    }

    // Get the title
    if (isset($_POST["newsTitle"])) {
        $title = trim($_POST["newsTitle"]);

        if (strlen($title) == 0) {
            $invalidTitle = "A news article must include a title!";
        }
    }
}
?>

<main>

    <!-- Admin Page -->
    <div class="container">
        <div class="custom-box mb-3 mt-3">
            <form enctype="multipart/form-data" method="post">
                <label class="form-label" for="thumbnail">Thumbnail</label>
                <input type="file" class="form-control <?= !empty($invalidUpload) ? 'is-invalid' : '' ?>"
                    accept="image/jpeg,image/png" id="thumbnail" name="thumbnail">
                <?= !empty($invalidUpload) ? '<div class="invalid-feedback is-invalid">' . $invalidUpload . '</div>' : '' ?>

                <label for="newsTitle"
                    class="form-label mt-3 <?= !empty($invalidTitle) ? 'is-invalid' : '' ?>">Title</label>
                <textarea class="form-control <?= !empty($invalidTitle) ? 'is-invalid' : '' ?>" id="newsTitle"
                    name="newsTitle" rows="1"><?= $title ?></textarea>
                <?= !empty($invalidTitle) ? '<div class="invalid-feedback is-invalid">' . $invalidTitle . '</div>' : '' ?>

                <label for="newsText" class="form-label mt-3">News Text</label>
                <textarea class="form-control" id="newsText" name="newsText" rows="3"></textarea>

                <button class="btn btn-primary mt-3" type="submit">Post</button>
            </form>
        </div>
    </div>
    <!-- User page -->

    <div class="row mb-2 mx-2">
        <div class="col-md-6">
            <div
                class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                    <h3 class="mb-0">Featured post</h3>
                    <div class="mb-1 text-body-secondary">Nov 12</div>
                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to
                        additional content.</p>
                    <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                        Continue reading
                        <svg class="bi">
                            <use xlink:href="#chevron-right"></use>
                        </svg>
                    </a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                        role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                        focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Thumbnail</text>
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div
                class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                    <h3 class="mb-0">Featured post</h3>
                    <div class="mb-1 text-body-secondary">Nov 12</div>
                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to
                        additional content.</p>
                    <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                        Continue reading
                        <svg class="bi">
                            <use xlink:href="#chevron-right"></use>
                        </svg>
                    </a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                        role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                        focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Thumbnail</text>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

include("inc/footer.php");
?>