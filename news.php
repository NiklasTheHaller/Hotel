<?php
$pageTitle = "News";
$metaDesc = "Hotel Mama's newspage";
include("inc/header.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form processing code

    if (is_uploaded_file($_FILES["thumbnail"]["tmp_name"])) {
        $tempFile = $_FILES["thumbnail"]["tmp_name"];


        //img must be over 0 MB
        //img must be under 3 MB
        //datatype jpeg and png
        //resize img with imagescale() php function


        $targetDirectory = __DIR__ . "/uploads/news";
        $filename = basename($_FILES["thumbnail"]["name"]);
        $targetFile = $targetDirectory . "/" . $filename;

        if (!move_uploaded_file($tempFile, $targetFile)) {
            $invalidNewsContent = "File could not be uploaded";
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
                <input type="file" class="form-control" accept="image/jpeg,image/png" id="thumbnail" name="thumbnail">

                <label for="newsTitle" class="form-label mt-3">Title</label>
                <textarea class="form-control" id="newsTitle" name="newsTitle" rows="1"></textarea>

                <label for="newsText" class="form-label mt-3">News Text</label>
                <textarea class="form-control" id="newsText" name="newsText" rows="3"></textarea>

                <button class="btn btn-primary mt-3" type="submit">Post</button>
            </form>
        </div>
    </div>

    <!-- User page -->

    <div class="row mb-2 mx-2">
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white">
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
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
                    <h3 class="mb-0">Post title</h3>
                    <div class="mb-1 text-body-secondary">Nov 11</div>
                    <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to
                        additional content.</p>
                    <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                        Continue reading
                        <svg class="bi">
                            <use xlink:href="#chevron-right"></use>
                        </svg>
                    </a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

include("inc/footer.php");
?>