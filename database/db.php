<?php
$host = "localhost";
$user = "root";
$password = "8767";
$database = "plant_rental";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
