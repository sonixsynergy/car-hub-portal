


<?php
session_start();
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF Token validation
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    // Fetch user ID if logged in (Modify as needed)
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

    // Retrieve form data
    $vehicle_id = isset($_POST['vehicle_id']) ? intval($_POST['vehicle_id']) : NULL;
    $customer_name = trim($_POST['customer_name']);
    $customer_email = trim($_POST['customer_email']);
    $customer_phone = trim($_POST['customer_phone']);
    $booking_date = $_POST['booking_date'];
    $additional_notes = trim($_POST['additional_notes']);

    // Default status
    $status = "Pending";

    // Insert into database
    $sql = "INSERT INTO book_decor_info (user_id, vehicle_id, booking_date, status, customer_name, customer_email, customer_phone, additional_notes) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssss", $user_id, $vehicle_id, $booking_date, $status, $customer_name, $customer_email, $customer_phone, $additional_notes);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='car_decor.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Decoration Booking</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Car Decoration Booking</h2>
    <form action="submit_booking.php" method="POST">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="form-group">
            <label for="customer_name">Full Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>

        <div class="form-group">
            <label for="customer_email">Email:</label>
            <input type="email" id="customer_email" name="customer_email" required>
        </div>

        <div class="form-group">
            <label for="customer_phone">Phone Number:</label>
            <input type="tel" id="customer_phone" name="customer_phone" required>
        </div>

        <div class="form-group">
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" required>
        </div>

        <div class="form-group">
            <label for="additional_notes">Additional Notes:</label>
            <textarea id="additional_notes" name="additional_notes" rows="3"></textarea>
        </div>

        <button href="car_decor.php"  type="submit">Book Now</button>
    </form>
    
</div>

</body>
</html>
