<?php
include("inc/header.php");
require_once("config/db_config.php");

// Get the user id from the GET parameter
$id = $_GET["id"];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user data from the POST parameters
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $isAdmin = isset($_POST["isAdmin"]) ? 1 : 0;
    $isActive = isset($_POST["isActive"]) ? 1 : 0;

    // Prepare the statement with placeholders for the user data
    $query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, gender = ?, isAdmin = ?, active = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    // Bind the user data parameters
    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $gender, $isAdmin, $isActive, $id);

    // Execute the statement
    $stmt->execute();

    // If the user being edited is the same as the logged in user, update the session variables
    if ($_SESSION["id"] == $id) {
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["gender"] = $gender;
        $_SESSION["isAdmin"] = $isAdmin;
        $_SESSION["isActive"] = $isActive;
    }

    // Redirect back to the user panel
    header("Location: admin.php");
} else {
    // Prepare the statement with a placeholder for the user ID
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);

    // Bind the user ID parameter
    $stmt->bind_param("s", $id);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($id, $firstname, $lastname, $userpassword, $email, $gender, $isAdmin, $isActive);

    // Fetch the user data
    if ($stmt->fetch()) {
        // Display the user data in a form for editing
?>
        <div class="profile-box mb-3 mt-3">
            <h1>Edit User</h1>
            <form action='edit_user.php?id=<?php echo $id; ?>' method='post'>
                <input type='hidden' name='id' value='<?php echo $id; ?>'>
                <div class="mb-3">
                    <label for="firstname" class="form-label">Firstname:</label>
                    <input type='text' class='form-control' name='firstname' value='<?php echo $firstname; ?>'>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Lastname:</label>
                    <input type='text' class='form-control' name='lastname' value='<?php echo $lastname; ?>'>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type='text' class='form-control' name='email' value='<?php echo $email; ?>'>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class='form-select' name='gender'>
                        <option value='male' <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value='female' <?php echo ($gender == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value='other' <?php echo ($gender == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="isAdmin" class="form-label">Admin:</label>
                    <input type='checkbox' name='isAdmin' <?php echo ($isAdmin == 1) ? 'checked' : ''; ?>>
                </div>
                <div class="mb-3">
                    <label for="isActive" class="form-label">Active:</label>
                    <input type='checkbox' name='isActive' <?php echo ($isActive == 1) ? 'checked' : ''; ?>>
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