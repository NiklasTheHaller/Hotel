<?php
$dbhost = "localhost";
$dbuser = "hotelmamaadmin";
$dbpassword = "@.[kybj0d*9hMc2x";
$dbname = "hoteldatabase";

// Check if a database connection already exists
if (!isset($conn)) {
    // Create connection
    $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    $conn->set_charset("utf8");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }
}
// echo "Connected successfully";
