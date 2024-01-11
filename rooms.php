<?php
$pageTitle = "Hotel Mama | Booking";
$metaDesc = "Explore and book rooms at Hotel Mama";
include("inc/header.php");
require_once("config/db_config.php");

// Get the page number from the URL, default is 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the start index for the SQL query
$start = ($page - 1) * 15;

// Fetch and display hotel rooms
$sql = "SELECT * FROM rooms ORDER BY id DESC LIMIT ?, 15";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $start);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';

    // Output data of each room
    while ($row = $result->fetch_assoc()) {
        // Get the first couple of words of the room description
        $descriptionPreview = implode(' ', array_slice(explode(' ', $row["roomdescription"]), 0, 18)) . '...';

        echo '<div class="col">
                <div class="card shadow-sm object-fit-contain">
                    <img src="' . $row["imagepath"] . '" height="225" class="object-fit-cover border rounded" alt="' . '">
                    <div class="card-body">
                        <p class="card-text">' . $descriptionPreview . '</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-text">$' . $row["price"] . '</h3>
                            <a class="btn btn-sm btn-outline-secondary" href="room.php?id=' . $row["id"] . '" role="button">Details</a>
                        </div>
                    </div>
                </div>
            </div>';
    }
    echo '</div>
        </div>
        </div>';
} else {
    echo '<div class="custom-box mx-5">' . "No results" . '</div>';
}

$conn->close();
?>

</main>

<?php
include("inc/footer.php");
?>
