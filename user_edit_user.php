<?php
include("inc/header.php");
require_once("config/db_config.php");

// Get the user id from the session variable
$id = $_SESSION["uid"];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user data from the POST parameters
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $gender = $_POST["gender"];

    // Prepare the statement with placeholders for the user data
    $query = "UPDATE users SET firstname = ?, lastname = ?, gender = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    // Bind the user data parameters
    $stmt->bind_param("sssi", $firstname, $lastname, $gender, $id);

    // Execute the statement
    if (!$stmt->execute()) {
        die("Error updating user: " . $stmt->error);
    }

    // If the user being edited is the same as the logged in user, update the session variables
    if ($_SESSION["uid"] == $id) {
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["gender"] = $gender;
    }

    // Redirect to profile.php
    header("Location: profile.php");
    exit();
} else {
    // Prepare the statement with a placeholder for the user ID
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id, $firstname, $lastname, $userpassword, $email, $gender, $isAdmin, $isActive);

    // Fetch the user data
    if ($stmt->fetch()) {
?>
        <div class="profile-box mb-3 mt-3">
            <h1>Edit Profile</h1>
            <form action='profile.php' method='post'> <!-- Update the action attribute -->
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name:</label>
                    <input type='text' class='form-control' name='firstname' value='<?php echo $firstname; ?>' required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name:</label>
                    <input type='text' class='form-control' name='lastname' value='<?php echo $lastname; ?>' required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class='form-select' name='gender' required>
                        <option value='male' <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value='female' <?php echo ($gender == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value='other' <?php echo ($gender == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
<?php
    } else {
        echo "No user found with the given ID.";
    }
}
?>