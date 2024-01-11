<?php
$pageTitle = "Hotel Mama | News";
$metaDesc = "Hotel Mama's newspage";
include("inc/header.php");
require_once("config/db_config.php");

// Get the page number from the URL, default is 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the start index for the SQL query
$start = ($page - 1) * 15;

// Fetch and display news articles
$sql = "SELECT news.*, users.firstname, users.lastname FROM news JOIN users ON news.fk_user_id = users.id ORDER BY news.id DESC LIMIT ?, 15";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $start);
$stmt->execute();
$result = $stmt->get_result();

?>

<main>

<?php

if ($result->num_rows > 0) {
    echo '<div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col">
                <div class="card shadow-sm object-fit-contain">
                    <img src="' . $row["imagepath"] . '" height="225" class="object-fit-cover border rounded" alt="' . $row["title"] . '">
                    <div class="card-body">
                        <h3 class="card-text">' . $row["title"] . '</h3>
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-sm btn-outline-secondary" href="newspost.php?id=' . $row["id"] . '" role="button">Read more!</a>
                            <small class="text-body-secondary"> ' . $row["firstname"] . ' ' . $row["lastname"] . ' | ' . $row["newstimestamp"] . '</small>
                        </div>
                    </div>
                </div>
            </div>';
    }
    echo '</div>
        </div>
        </div>';
} else {
    
    echo '<div class="custom-box mx-5">'. "No results" . '</div>';
 
}


$conn->close();
?>


</main>

<?php
include("inc/footer.php");
?>