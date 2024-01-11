<?php
// Include necessary files and configurations
$pageTitle = "Hotel Mama | Admin";
$metaDesc = "Admin panel";
include("inc/header.php");
require_once("config/db_config.php");
?>

<main>
    <?php
    // Check user authentication and admin status
    $sql = "SELECT id, firstname, lastname, isAdmin FROM users";
    $result = $conn->query($sql);
    if (isset($_SESSION["active"]) && $_SESSION["isAdmin"] === 1) :
    ?>
        <!-- Admin Page -->
        <div class="container">

            <!-- News Posting -->
            <div class="custom-box mb-3 mt-3">
                <h1>News Panel</h1>
                <div class="custom-box">
                    <form enctype="multipart/form-data" method="post" action="newslogic.php">
                        <!-- Form fields for News Panel -->
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control <?= !empty($invalidUpload) ? 'is-invalid' : '' ?>" accept="image/jpeg,image/png" id="thumbnail" name="thumbnail">
                            <?= !empty($invalidUpload) ? '<div class="invalid-feedback is-invalid">' . $invalidUpload . '</div>' : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="newsTitle" class="form-label <?= !empty($invalidTitle) ? 'is-invalid' : '' ?>">Title</label>
                            <textarea class="form-control <?= !empty($invalidTitle) ? 'is-invalid' : '' ?>" id="newsTitle" name="newsTitle" rows="1"><?= $title ?></textarea>
                            <?= !empty($invalidTitle) ? '<div class="invalid-feedback is-invalid">' . $invalidTitle . '</div>' : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="newsText" class="form-label">News Text</label>
                            <textarea class="form-control" id="newsText" name="newsText" rows="3"></textarea>
                        </div>

                        <button class="btn btn-primary" type="submit" name="postNews">Post News</button>
                    </form>
                </div>
            </div>

            <!-- Room Editor -->
            <div class="custom-box mb-3 mt-3">
                <h1>Room Panel</h1>
                <div class="custom-box">
                    <form enctype="multipart/form-data" method="post" action="roomlogic.php">
                        <!-- Form fields for Room Panel -->
                        <div class="mb-3">
                            <label for="roomThumbnail" class="form-label">Room Thumbnail</label>
                            <input type="file" class="form-control <?= !empty($invalidUpload) ? 'is-invalid' : '' ?>" accept="image/jpeg,image/png" id="roomThumbnail" name="roomThumbnail">
                            <?= !empty($invalidUpload) ? '<div class="invalid-feedback is-invalid">' . $invalidUpload . '</div>' : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="roomTitle" class="form-label <?= !empty($invalidTitle) ? 'is-invalid' : '' ?>">Room Title</label>
                            <textarea class="form-control <?= !empty($invalidTitle) ? 'is-invalid' : '' ?>" id="roomTitle" name="roomTitle" rows="1"><?= $title ?></textarea>
                            <?= !empty($invalidTitle) ? '<div class="invalid-feedback is-invalid">' . $invalidTitle . '</div>' : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="roomDescription" class="form-label">Room Description</label>
                            <textarea class="form-control <?= !empty($invalidDescription) ? 'is-invalid' : '' ?>" id="roomDescription" name="roomDescription" rows="3" required></textarea>
                            <?= !empty($invalidDescription) ? '<div class="invalid-feedback is-invalid">' . $invalidDescription . '</div>' : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="roomPrice" class="form-label">Room Price</label>
                            <input type="text" class="form-control" id="roomPrice" name="roomPrice" required>
                        </div>

                        <div class="mb-3">
                            <label for="roomBreakfast" class="form-label">Include Breakfast</label>
                            <input type="text" class="form-control" id="roomBreakfast" name="roomBreakfast" value="7.50" required>
                        </div>

                        <div class="mb-3">
                            <label for="roomParking" class="form-label">Parking Available</label>
                            <input type="text" class="form-control" id="roomParking" name="roomParking" value="9.99" required>
                        </div>

                        <div class="mb-3">
                            <label for="roomPets" class="form-label">Pets Allowed</label>
                            <input type="text" class="form-control" id="roomPets" name="roomPets" value="5.99" required>
                        </div>

                        <button class="btn btn-primary" type="submit" name="addRoom">Add Room</button>
                    </form>
                </div>
            </div>

            <!-- User Editor -->
            <div class="custom-box mb-3 mt-3">
                <h1>User Panel</h1>

                <div class="custom-box">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Active</th>
                                <th>Admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Prepare the statement with a placeholder for the user ID
                            $query = "SELECT id, firstname, lastname, email, gender, active, isAdmin FROM users";
                            $stmt = $conn->prepare($query);

                            // Execute the statement
                            $stmt->execute();

                            // Bind the result variables in the correct order
                            $stmt->bind_result($id, $firstname, $lastname, $email, $gender, $active, $isAdmin);

                            // Fetch and display the user data
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $id . "</td>";
                                echo "<td>" . $firstname . "</td>";
                                echo "<td>" . $lastname . "</td>";
                                echo "<td>" . $email . "</td>";
                                echo "<td>" . $gender . "</td>";
                                echo "<td>" . ($active == 1 ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>') . "</td>";
                                echo "<td>" . ($isAdmin == 1 ? '<span class="text-danger">Admin</span>' : 'Customer') . "</td>";
                                echo "<td><a href='edit_user.php?id=" . $id . "' class='btn btn-primary'>Edit</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Booking confirmation page -->
            <?php
            // Handle Confirm and Cancel button clicks
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["confirm_booking_id"])) {
                    // Handle Confirm button click
                    $confirmBookingId = $_POST["confirm_booking_id"];

                    // Fetch the details of the booking to be confirmed
                    $fetchQuery = "SELECT fk_room_id, date_from, date_to FROM bookings WHERE id = ?";
                    $fetchStmt = $conn->prepare($fetchQuery);
                    $fetchStmt->bind_param("i", $confirmBookingId);
                    $fetchStmt->execute();
                    $fetchResult = $fetchStmt->get_result();
                    $bookingDetails = $fetchResult->fetch_assoc();

                    // Update the status to "confirmed" in the database
                    $updateQuery = "UPDATE bookings SET status = 'confirmed' WHERE id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("i", $confirmBookingId);

                    if ($updateStmt->execute()) {
                        // Update successful

                        // Automatically cancel overlapping bookings for the same room ID
                        $cancelOverlappingQuery = "UPDATE bookings SET status = 'canceled' WHERE fk_room_id = ? AND id != ? AND ((date_from < ? AND date_to > ?) OR (date_from >= ? AND date_to <= ?)) AND status = 'new'";
                        $cancelOverlappingStmt = $conn->prepare($cancelOverlappingQuery);
                        $cancelOverlappingStmt->bind_param("iiiiii", $bookingDetails['fk_room_id'], $confirmBookingId, $bookingDetails['date_to'], $bookingDetails['date_from'], $bookingDetails['date_from'], $bookingDetails['date_to']);
                        $cancelOverlappingStmt->execute();
                        $cancelOverlappingStmt->close();
                    } else {
                        // Update failed
                        $errorMessage = "Error updating status: " . $conn->error;
                    }

                    // Close the statement
                    $updateStmt->close();
                } elseif (isset($_POST["cancel_booking_id"])) {
                    // Handle Cancel button click
                    $cancelBookingId = $_POST["cancel_booking_id"];

                    // Check if the cancellation is automatic or staff-initiated
                    $automaticCancellation = isset($_POST["automatic_cancellation"]) ? 1 : 0;
                    $cancellationReason = "The booking was canceled by hotel staff";

                    // Update the status to "canceled" and store cancellation reason in the database
                    $cancelQuery = "UPDATE bookings SET status = 'canceled', cancellation_reason = ? WHERE id = ?";
                    $cancelStmt = $conn->prepare($cancelQuery);
                    $cancelStmt->bind_param("si", $cancellationReason, $cancelBookingId);

                    if ($cancelStmt->execute()) {
                        // Update successful
                    } else {
                        // Update failed
                        $errorMessage = "The booking was canceled by hotel staff";
                    }

                    // Close the statement
                    $cancelStmt->close();
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
                // Fetch data from bookings, users, and rooms tables with status filter
                $statusFilter = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : '';
                $query = "SELECT b.id AS booking_id, b.fk_room_id, b.booking_date, b.date_from, b.date_to, b.status, b.breakfast, b.pets, b.parking, u.id AS user_id, u.firstname, u.lastname, r.price, r.breakfast AS room_breakfast, r.parking AS room_parking, r.pets AS room_pets
    FROM bookings b
    INNER JOIN users u ON b.user_id = u.id
    INNER JOIN rooms r ON b.fk_room_id = r.id";

                // Apply status filter if selected
                if (!empty($statusFilter)) {
                    $query .= " WHERE b.status = ?";
                }

                $stmt = $conn->prepare($query);

                // Bind status parameter if filter is applied
                if (!empty($statusFilter)) {
                    $stmt->bind_param("s", $statusFilter);
                }

                $stmt->execute();
                $result = $stmt->get_result();
            }
            ?>

            <!-- Admin Booking Confirmation Panel HTML -->

            <div class="custom-box mb-3 mt-3">
                <h1>Admin Booking Confirmation Panel</h1>

                <!-- Filter Form -->
                <form action="" method="get">
                    <label for="statusFilter" class="form-label">Filter by Status:</label>
                    <select name="statusFilter" id="statusFilter" class="form-select">
                        <option value="">All</option>
                        <option value="confirmed" <?php echo ($statusFilter == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                        <option value="canceled" <?php echo ($statusFilter == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                        <option value="new" <?php echo ($statusFilter == 'new') ? 'selected' : ''; ?>>New</option>
                    </select>
                    <button type="submit" class="btn btn-primary mt-2">Apply Filter</button>
                </form>

                <!-- Table -->
                <div class="custom-box">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room ID</th>
                                <th>Price</th>
                                <th>Booking Date</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Status</th>
                                <th>Breakfast</th>
                                <th>Pets</th>
                                <th>Parking</th>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                // Apply Bootstrap contextual class to the whole row based on status
                                $rowClass = '';
                                switch ($row['status']) {
                                    case 'confirmed':
                                        $rowClass = 'table-success';
                                        break;
                                    case 'canceled':
                                        $rowClass = 'table-danger';
                                        break;
                                    case 'new':
                                        $rowClass = 'table-warning';
                                        break;
                                }

                                echo "<tr class='" . $rowClass . "'>";
                                echo "<td class='align-middle'>" . $row['booking_id'] . "</td>";
                                echo "<td class='align-middle'>" . $row['fk_room_id'] . "</td>";

                                // Calculate the culmination of price and selected additions

                                $culminationPrice = $row['price'] + ($row['breakfast'] ? $row['room_breakfast'] : 0) + ($row['parking'] ? $row['room_parking'] : 0) + ($row['pets'] ? $row['room_pets'] : 0);
                                echo "<td class='align-middle'>" . $culminationPrice . "</td>";

                                echo "<td class='align-middle'>" . $row['booking_date'] . "</td>";
                                echo "<td class='align-middle'>" . $row['date_from'] . "</td>";
                                echo "<td class='align-middle'>" . $row['date_to'] . "</td>";
                                echo "<td class='align-middle'>" . $row['status'] . "</td>";
                                echo "<td class='align-middle'>" . ($row['breakfast'] ? 'Yes' : 'No') . "</td>";
                                echo "<td class='align-middle'>" . ($row['pets'] ? 'Yes' : 'No') . "</td>";
                                echo "<td class='align-middle'>" . ($row['parking'] ? 'Yes' : 'No') . "</td>";
                                echo "<td class='align-middle'>" . $row['user_id'] . "</td>";
                                echo "<td class='align-middle'>" . $row['firstname'] . "</td>";
                                echo "<td class='align-middle'>" . $row['lastname'] . "</td>";
                                echo "<td class='align-middle'>";

                                // Display buttons conditionally based on status
                                if ($row['status'] == 'confirmed') {
                                    echo "<form action='' method='post'>";
                                    echo "<input type='hidden' name='cancel_booking_id' value='" . $row['booking_id'] . "'>";
                                    echo "<input type='hidden' name='automatic_cancellation' value='1'>";
                                    echo "<button type='submit' class='btn btn-danger mt-2'>Cancel</button>";
                                    echo "</form>";
                                } elseif ($row['status'] == 'new') {
                                    // Show both Confirm and Cancel buttons for new bookings
                                    echo "<form action='' method='post'>";
                                    echo "<input type='hidden' name='confirm_booking_id' value='" . $row['booking_id'] . "'>";
                                    echo "<button type='submit' class='btn btn-success me-2'>Confirm</button>";
                                    echo "</form>";
                                    echo "<form action='' method='post'>";
                                    echo "<input type='hidden' name='cancel_booking_id' value='" . $row['booking_id'] . "'>";
                                    echo "<button type='submit' class='btn btn-danger mt-2'>Cancel</button>";
                                    echo "</form>";
                                }

                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>





        </div>
    <?php endif; ?>
</main>

<?php
// Include footer
include("inc/footer.php");
?>