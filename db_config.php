<?php
$servername = "localhost"; // Keep this as "localhost"
$username = "root"; // Default MySQL username
$password = ""; // No password (empty string)
$database = "carrental"; // Your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
