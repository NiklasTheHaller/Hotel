<?php
$pageTitle = "Account";
$metaDesc = "Your account page";
include("inc/header.php");

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
}



// Function to determine if the form is in "edit" mode
function isEditMode()
{
    return isset($_GET["edit"]) && $_GET["edit"] == "true";
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
                            <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo isset($_SESSION["firstname"]) ? $_SESSION["firstname"] : '' ?>" <?php echo (isEditMode() ? '' : 'readonly'); ?>>
                        </div>


                        <div class="col mb-3">
                            <legend>Last Name</legend>
                            <label for="lastname" class="form-label"></label>
                            <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo isset($_SESSION["lastname"]) ? $_SESSION["lastname"] : '' ?>" <?php echo (isEditMode() ? '' : 'readonly'); ?>>
                        </div>
                    </div>

                    <?php if (isEditMode()) : ?>
                        <button class="btn btn-outline-success" type="submit">Done</button>
                    <?php else : ?>
                        <a class="btn btn-outline-info" href="?edit=true">Edit</a>
                    <?php endif; ?>
                </fieldset>

            </form>

            <br>
            <div>
                <label class="form-label" for="profilepicture">Upload Profile Picture</label>
                <input type="file" class="form-control" id="profilepicture" name="profilepicture">
            </div>
        </div>
    </div>

</main>



<?php
include("inc/footer.php")
?>