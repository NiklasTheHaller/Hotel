<?php
$pageTitle = "Bookings";
$metaDesc = "Your room bookings";
include("inc/header.php");
require_once("config/db_config.php");

// Fetch bookings for the current user
$query = "SELECT b.fk_room_id, b.date_from, b.date_to, b.breakfast, b.pets, b.parking, b.cancellation_reason, b.status
          FROM bookings b
          WHERE b.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION["uid"]);
$stmt->execute();

// Check for query execution errors
if ($stmt->error) {
    die("Error executing query: " . $stmt->error);
}

$result = $stmt->get_result();
?>

<div class="container custom-box mt-5">
    <h1>Your Room Bookings</h1>

    <?php if ($result->num_rows > 0) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Breakfast</th>
                    <th>Pets</th>
                    <th>Parking</th>
                    <th>Cancellation Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr class="<?= getStatusClass($row['status']) ?>">
                        <td><?= $row['fk_room_id'] ?></td>
                        <td><?= $row['date_from'] ?></td>
                        <td><?= $row['date_to'] ?></td>
                        <td><?= $row['breakfast'] ?></td>
                        <td><?= $row['pets'] ?></td>
                        <td><?= $row['parking'] ?></td>
                        <td><?= $row['cancellation_reason'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>

<?php
// Function to determine Bootstrap contextual class based on status
function getStatusClass($status)
{
    switch ($status) {
        case 'canceled':
            return 'table-danger';
        case 'confirmed':
            return 'table-success';
        case 'new':
            return 'table-warning';
        default:
            return '';
    }
}
?>