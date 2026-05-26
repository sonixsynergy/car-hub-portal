<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the vehicle record to get the image filename
    $query = "SELECT vehicle_image FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($vehicle_image);
    $stmt->fetch();
    $stmt->close();

    if ($vehicle_image) {
        // Define the image path
        $image_path = "uploads/" . $vehicle_image;
        
        // Delete the image file if it exists
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Delete the vehicle record from the database
    $deleteQuery = "DELETE FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Vehicle deleted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error deleting vehicle.'); window.location.href='index.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.php';</script>";
}

$conn->close();
?>
