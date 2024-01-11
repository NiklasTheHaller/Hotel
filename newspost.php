<?php
$pageTitle = "Hotel Mama | News";
$metaDesc = "Hotel Mama's newspage";
include("inc/header.php");
require_once("config/db_config.php");

// Get the id from the URL
$id = $_GET['id'];

// Fetch the news article
$sql = "SELECT news.*, users.firstname, users.lastname FROM news JOIN users ON news.fk_user_id = users.id WHERE news.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<div class="container">
    <div class="custom-box">
        <h1 class="display-4"><?php echo $row["title"]; ?></h1>
        <div class="row">
            <div class="col-md-6">
                <p><?php echo $row["newstext"]; ?></p>
            </div>
            <div class="col-md-6">
                <img src="<?php echo $row["imagepath"]; ?>" class="img-fluid rounded" alt="<?php echo $row["title"]; ?>">
            </div>
        </div>
        <p><?php echo $row["firstname"] . ' ' . $row["lastname"] . ' | ' . $row["newstimestamp"]; ?></p>
    </div>
</div>

<?php
include("inc/footer.php");
?>