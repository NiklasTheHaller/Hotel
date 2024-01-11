<?php
$pageTitle = "Hotel Mama | Account";
$metaDesc = "Your account page";
include("inc/header.php");
require_once("config/db_config.php");

?>

<main>
    <div class="container">
        <div class="mb-3 profile-box mt-2">

            <h3>Profile</h3>

            <?php
            // Prepare the statement with placeholders for the user ID and active field
            $query = "SELECT * FROM users WHERE id = ? AND active = 1";
            $stmt = $conn->prepare($query);

            // Bind the user ID parameter
            $stmt->bind_param("s", $_SESSION["uid"]);

            // Execute the statement
            $stmt->execute();

            // Bind the result variables
            $stmt->bind_result($uid, $ufirstname, $ulastname, $upassword, $uemail, $ugender, $uisadmin, $uactive);

            // Fetch and display the user data
            while ($stmt->fetch()) {
            ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">User Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Account ID:</strong> <?php echo $uid; ?>
                        </div>
                        <div class="mb-3">
                            <strong>First Name:</strong> <?php echo $ufirstname; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Last Name:</strong> <?php echo $ulastname; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> <?php echo $uemail; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Gender:</strong> <?php echo $ugender; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Account privilleges:</strong>
                            <?php
                            if ($uisadmin == 1) {
                                echo '<span class="text-danger">Admin</span>';
                            } else {
                                echo 'Customer Account';
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <strong>Account status:</strong>
                            <?php
                            if ($uactive == 1) {
                                echo '<span class="text-success">Active</span>';
                            } else {
                                echo '<span class="text-danger">Inactive</span>';
                            }
                            ?>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>

            <a class="btn btn-primary" href="user_edit_user.php" role="button">Edit Profile Data</a>

            <a class="btn btn-primary" href="changepassword.php" role="button">Change Password</a>

            <br>
            <!-- Add profile changing option -->
            <div class="">
                <div class="mb-3 mt-3">
                    <form enctype="multipart/form-data" method="post">
                        <label class="form-label" for="profilepicture">
                            <legend>Profile Picture</legend>
                        </label>
                        <input type="file" class="form-control" accept="image/jpeg,image/png" id="profilepicture" name="profilepicture">
                        <button class="btn btn-primary mt-3" type="submit">Update Profile Picture</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<?php
include("inc/footer.php")
?>