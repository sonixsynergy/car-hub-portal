<?php
session_start(); // Start session at the very beginning

// Database connection
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$database = "carrental";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging: Check session status
if (!isset($_SESSION['login'])) {
    echo "<p class='error'>Error: User not logged in.</p>";
    exit;
}

// Fetch user details using email
$email = $_SESSION['login'];
$sql = "SELECT FullName, EmailId FROM tblusers WHERE EmailId = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $fullName = htmlspecialchars($row["FullName"]);
        $emailId = htmlspecialchars($row["EmailId"]);
    } else {
        echo "<p class='error'>Error: User not found in database.</p>";
        exit;
    }

    $stmt->close();
} else {
    echo "<p class='error'>Error in SQL query.</p>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booking Confirmation</title>
    <style>
        body {
            background-image: url('/CRP/CRP/carrental/admin/img/DEAL.jpg'); /* Adjust the path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            
            color: #fff;
            text-align: center;
            
        }
        .container {
            background: rgba(0, 0, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }
        h2 {
            color: #ffcc00;
        }
        p {
            font-size: 18px;
        }
        .user-info {
            font-size: 20px;
            font-weight: bold;
            color: #ffcc00;
        }
        .thank-you {
            margin-top: 20px;
            font-size: 22px;
            font-weight: bold;
            background: #ffcc00;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .contact-message {
            margin-top: 15px;
            font-size: 18px;
            color: #fff;
        }
        .thank-you {
    background-color: yellow; /* Yellow Background */
    color: black; /* Black Text */
    font-size: 18px; /* Responsive Font */
    padding: 12px 24px; /* Comfortable Padding */
    border: none; /* Remove Default Border */
    border-radius: 8px; /* Rounded Corners */
    cursor: pointer; /* Pointer Cursor */
    font-weight: bold; /* Bold Text */
    text-transform: uppercase; /* Uppercase Text */
    transition: all 0.3s ease-in-out; /* Smooth Transition */
    display: inline-block; /* Ensures Proper Display */
}

/* Hover Effect */
.thank-you:hover {
    background-color: orange; /* Slightly Darker on Hover */
    color: white; /* White Text */
    transform: scale(1.05); /* Slight Zoom Effect */
}

/* Responsive Design */
@media (max-width: 600px) {
    .thank-you {
        font-size: 16px;
        padding: 10px 20px;
    }
}

    </style>
</head>
<body>

    <br><br><br><br><br><br><br><br><br><br><br><div class="container">
  <h3> Dear</h3><br<h1><?php echo $fullName; ?></h1><br>

        <h2>Thank You for Booking a Decor Car!</h2>
        <p>We appreciate your trust in our service. </p>
        <p class="contact-message">Our Team Will Contact You Soon On Your   <?php echo $emailId; ?> E-mail For Further Details.</p>
        <div><p> is your booking information </p></div>
        <div class="user-info">
       
       
        </div>
        <div class="thank-you">We look forward to serving you!</div>
        <a href="http://localhost/CRP/CRP/carrental/index.php" class="thank-you"  class="thank-you1" >HOME</button>
</a>
        
    </div>
</body>
</html>
