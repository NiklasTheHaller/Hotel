<?php
$pageTitle = "Hotel Mama | Change Password";
$metaDesc = "Change Password Page";
include("inc/header.php");

$oldPassword = $newPassword = $confirmNewPassword = "";
$isValidSubmission = true;

require_once("config/db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["oldpassword"])) {
        $oldPassword = trim($_POST["oldpassword"]);
    }

    if (isset($_POST["newpassword"])) {
        $newPassword = trim($_POST["newpassword"]);

        if (strlen($newPassword) == 0) {
            $invalidNewPassword = "Please enter your new password";
            $isValidSubmission = false;
        } elseif (strlen($newPassword) < 8) {
            $invalidNewPassword = "Your new password must contain at least 8 characters";
            $isValidSubmission = false;
        } elseif (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $newPassword)) {
            $invalidNewPassword = "Your new password must contain at least one special character";
            $isValidSubmission = false;
        }
    }

    if (isset($_POST["confirmnewpassword"])) {
        $confirmNewPassword = trim($_POST["confirmnewpassword"]);

        if (strlen($confirmNewPassword) == 0) {
            $invalidConfirmNewPassword = "Please confirm your new password";
            $isValidSubmission = false;
        } elseif ($confirmNewPassword != $newPassword) {
            $invalidConfirmNewPassword = "Your new passwords do not match";
            $isValidSubmission = false;
        }
    }

    // If the submission is valid, check old password, hash the new password, and update in the database
    if ($isValidSubmission) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT userpassword FROM users WHERE id = ?");
        $stmt->bind_param("s", $_SESSION["id"]);
        $stmt->execute();
        $stmt->bind_result($dbPassword);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($oldPassword, $dbPassword)) {
            // Old password is correct, update with new password
            $stmt = $conn->prepare("UPDATE users SET userpassword = ? WHERE id = ?");
            $stmt->bind_param("ss", $hashedNewPassword, $_SESSION["id"]);

            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Execute the statement
            $stmt->execute();

            echo "Password updated successfully";

            // Close the statement
            $stmt->close();
        } else {
            $invalidOldPassword = "Incorrect old password";
            $isValidSubmission = false;
        }
    }
}
?>

<main class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="custom-box my-5">
                    <form class="container mt-4" action="" method="post" novalidate>
                        <img class="mb-4 justify-center" src="img/icons8-hotel-48.png" alt="Hotel Logo">

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password" class="form-control <?= !empty($invalidOldPassword) ? 'is-invalid' : '' ?>" id="oldpassword" name="oldpassword" placeholder="*********" required>
                                <label for="oldpassword">Old Password</label>
                                <?= !empty($invalidOldPassword) ? '<div class="invalid-feedback is-invalid">' . $invalidOldPassword . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password" class="form-control <?= !empty($invalidNewPassword) ? 'is-invalid' : '' ?>" id="newpassword" name="newpassword" placeholder="*********" required>
                                <label for="newpassword">New Password</label>
                                <?= !empty($invalidNewPassword) ? '<div class="invalid-feedback is-invalid">' . $invalidNewPassword . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password" class="form-control <?= !empty($invalidConfirmNewPassword) ? 'is-invalid' : '' ?>" id="confirmnewpassword" name="confirmnewpassword" placeholder="Re-enter your new password" required>
                                <label for="confirmnewpassword">Confirm New Password</label>
                                <?= !empty($invalidConfirmNewPassword) ? '<div class="invalid-feedback is-invalid">' . $invalidConfirmNewPassword . '</div>' : '' ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include("inc/footer.php")
?>