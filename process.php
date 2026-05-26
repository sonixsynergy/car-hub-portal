<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "carrental");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and sanitize inputs
    $vehicle_title = mysqli_real_escape_string($conn, $_POST['vehicle_title']);
    $vehicle_brand = mysqli_real_escape_string($conn, $_POST['vehicle_brand']);
    $vehicle_price = mysqli_real_escape_string($conn, $_POST['vehicle_price']);
    $fuel_type = mysqli_real_escape_string($conn, $_POST['fuel_type']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $seating_capacity = mysqli_real_escape_string($conn, $_POST['seating_capacity']);
    $registration_date = mysqli_real_escape_string($conn, $_POST['registration_date']);

    // Image upload logic
    $target_dir = "uploads/";
    $vehicle_image = $_FILES['vehicle_image']['name'];
    $target_file = $target_dir . basename($vehicle_image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["vehicle_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit();
    }

    // Check file size (5MB max)
    if ($_FILES["vehicle_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        exit();
    }

    // Allow file formats (e.g., jpg, png, jpeg, gif)
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit();
    }

    // Insert data into database
    $sql = "INSERT INTO vehicles (vehicle_title, vehicle_brand, vehicle_price, fuel_type, model, seating_capacity, vehicle_image, registration_date)
            VALUES ('$vehicle_title', '$vehicle_brand', '$vehicle_price', '$fuel_type', '$model', '$seating_capacity', '$vehicle_image', '$registration_date')";

    if ($conn->query($sql) === TRUE) {
        $message = "New vehicle added successfully!";
        echo "<script>alert('Vehicle Added');</script>"; // Show alert
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD VEHICLE</title>
    <style>
        body {
            background: linear-gradient(to right, #ffeb99, #ff9999);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background: #ff6666;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background: #cc0000;
        }
        .message {
            text-align: center;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Vehicle</h2>
        <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Vehicle Title:</label>
            <input type="text" name="vehicle_title" required>
            
            <label>Vehicle Brand:</label>
            <input type="text" name="vehicle_brand" required>
            
            <label>Decoration Price:</label>
            <input type="text" name="vehicle_price" required>
            
            <label>Fuel Type:</label>
            <input type="text" name="fuel_type" required>
            
            <label>Model:</label>
            <input type="text" name="model" required>
            
            <label>Seating Capacity:</label>
            <input type="number" name="seating_capacity" required>
            
            <label>Vehicle Image:</label>
            <input type="file" name="vehicle_image" required>
            
            <label>Registration Date:</label>
            <input type="date" name="registration_date" required>
            
            <input type="submit" value="Add Vehicle">
        </form>
    </div>
</body>
</html>
