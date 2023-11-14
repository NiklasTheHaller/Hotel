<?php
$pageTitle = "Account";
$metaDesc = "Your account page";

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


include("inc/header.php");
?>


<main>

    <div class="container">
        <div class="mb-3 custom-box mt-2">

            <h3>First Name</h3>


            <form action="" method="post">
                <fieldset <?php echo (isEditMode() ? '' : 'disabled'); ?>>
                    <legend>First Name</legend>
                    <div class="mb-3">
                        <label for="firstname" class="form-label"></label>
                        <input type="text" id="firstname" name="firstname" class="form-control"
                            value="<?php echo $_SESSION["firstname"] ?>" <?php echo (isEditMode() ? '' : 'readonly'); ?>>
                    </div>

                    <legend>Last Name</legend>
                    <div class="mb-3">
                        <label for="lastname" class="form-label"></label>
                        <input type="text" id="lastname" name="lastname" class="form-control"
                            value="<?php echo $_SESSION["lastname"] ?>" <?php echo (isEditMode() ? '' : 'readonly'); ?>>
                    </div>

                    <?php if (isEditMode()): ?>
                        <button class="btn " type="submit">Done</button>
                    <?php else: ?>
                        <a href="?edit=true">Edit</a>
                    <?php endif; ?>
                </fieldset>
            </form>

            <br>
            <label class="form-label" for="customFile">Upload Profile Picture</label>
            <input type="file" class="form-control" id="customFile">
        </div>
    </div>

</main>



<?php
include("inc/footer.php")
    ?>