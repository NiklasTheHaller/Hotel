<?php
$pageTitle = "Hotel Mama | Room Details";
$metaDesc = "Details of the selected room";
include("inc/header.php");
require_once("config/db_config.php");

// Get the id from the URL
$id = $_GET['id'];

// Fetch the room details
$sql = "SELECT * FROM rooms WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();

// Fetch booked periods for the room
$bookedPeriodsQuery = "SELECT date_from, date_to, status FROM bookings WHERE fk_room_id = ?";
$bookedStmt = $conn->prepare($bookedPeriodsQuery);
$bookedStmt->bind_param("i", $id);
$bookedStmt->execute();
$bookedResult = $bookedStmt->get_result();

// Fetch booked periods for the room
$bookedPeriods = [];
while ($period = $bookedResult->fetch_assoc()) {
    $bookedPeriods[] = [
        'start' => $period['date_from'],
        'end' => $period['date_to'],
        'status' => $period['status'],
    ];
}

// Initialize success and error message variables
$successMessage = "";
$errorMessage = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dateFrom = $_POST["date_from"];
    $dateTo = $_POST["date_to"];
    $breakfast = isset($_POST["breakfast"]) ? 1 : 0;
    $parking = isset($_POST["parking"]) ? 1 : 0;
    $pets = isset($_POST["pets"]) ? 1 : 0;

    // Validate the dates and check availability
    $availabilityCheck = true;

    foreach ($bookedPeriods as $period) {
        if ($period['status'] === 'confirmed') {
            // Check if any day in the selected period conflicts with a confirmed booking
            if (!(strtotime($dateFrom) > strtotime($period['end']) || strtotime($dateTo) < strtotime($period['start']))) {
                $availabilityCheck = false;
                break;
            }
        }
    }

    if ($availabilityCheck) {
        // Insert the booking into the database with the status "new"
        $insertQuery = "INSERT INTO bookings (user_id, fk_room_id, booking_date, date_from, date_to, status, breakfast, parking, pets) VALUES (?, ?, CURRENT_DATE, ?, ?, 'new', ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("iissiii", $userId, $id, $dateFrom, $dateTo, $breakfast, $parking, $pets);

        // Set $userId to the session user id
        $userId = $_SESSION["uid"]; 

        // Execute the insert statement
        if ($insertStmt->execute()) {
            // Booking successful, set success message
            $successMessage = "You have successfully reserved the room!";
        } else {
            // Handle the error, display a message, or redirect to an error page
            $errorMessage = "Error: " . $conn->error;
        }

        // Close the statement
        $insertStmt->close();
    } else {
        // Display error message for availability conflict
        $errorMessage = "The room is not available for the selected period.";
    }
}

// Close the statements
$stmt->close();
$bookedStmt->close();
?>

<main class="bg-tertiary">
    <div class="container custom-box my-2">
        <!-- Room Details -->
        <div class="row">
            <div class="col-md-6">
                <?php echo '<img src="' . $room["imagepath"] . '" height="400" class="img-fluid rounded" alt="' . '">' ?>
            </div>
            <div class="col-md-6">
                <h2><?= $pageTitle ?></h2>
                <p class="lead"><?= $room['roomdescription'] ?></p>
                <p class="fw-bold">Price: $<?= $room['price'] ?> / night</p>
                <p>Would you like to include some of our offers in your booking?</p>

                <!-- Success Message -->
                <?php if (!empty($successMessage)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $successMessage ?>
                    </div>
                <?php endif; ?>

                <!-- Unavailable Periods -->
                <?php foreach ($bookedPeriods as $period) : ?>
                    <?php if ($period['status'] === 'confirmed') : ?>
                        <div class="alert alert-danger" role="alert">
                            Unavailable from <?= $period['start'] ?> to <?= $period['end'] ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <!-- Error Message -->
                <?php if (!empty($errorMessage)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $errorMessage ?>
                    </div>
                <?php endif; ?>

                <!-- Booking Form -->
                <form action="" method="post" class="my-4">
                    

                    <div class="mb-3">
                        <label for="date_from" class="form-label">Check-in Date:</label>
                        <input type="date" class="form-control" name="date_from" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_to" class="form-label">Check-out Date:</label>
                        <input type="date" class="form-control" name="date_to" required>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="breakfast" value="1" id="firstCheckbox">
                            <label class="form-check-label" for="firstCheckbox">Breakfast | +$<?= $room['breakfast'] ?> / night</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="parking" value="1" id="secondCheckbox">
                            <label class="form-check-label" for="secondCheckbox">Parking | +$<?= $room['parking'] ?> / night</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="pets" value="1" id="thirdCheckbox">
                            <label class="form-check-label" for="thirdCheckbox">Pets | +$<?= $room['pets'] ?> / night</label>
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-primary mt-2">Book Now!</button>
                </form>
                <!-- End Booking Form -->
            </div>
        </div>
    </div>
</main>

<?php
include("inc/footer.php");
?>