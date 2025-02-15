<?php
$host = "localhost";
$user = "root";
$password = "root";
$database = "plant_rental";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$con = mysqli_connect($host,$user,$password,$database);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
