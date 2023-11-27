<?php
$hostname = "localhost";
$username = "hotelmamaadmin";
$password = "@.[kybj0d*9hMc2x";
$dbname = "hoteldatabase";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>