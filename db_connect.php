<?php
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$database = "car_rental"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
