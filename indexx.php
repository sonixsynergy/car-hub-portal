<?php
include 'db_config.php';

// Query to fetch data
$sql = "SELECT id, vehicle_title, vehicle_brand, vehicle_price, fuel_type, model, seating_capacity, vehicle_image, registration_date FROM vehicles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Available Cars</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background: linear-gradient(to right, #ffeb99, #ff9999);
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .table-container {
            width: 90%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .no-data {
            text-align: center;
            font-size: 18px;
            color: #888;
            padding: 20px;
        }
        .delete-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .delete-btn:hover {
            background-color: darkred;
        }
        @media (max-width: 768px) {
            th, td {
                font-size: 14px;
                padding: 8px;
            }
            img {
                width: 80px;
                height: 50px;
            }
        }
    </style>
</head>
<body>

    <h2>🚗 Available Decorated Cars for Rent</h2>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Car Name</th>
                <th>Car Brand</th>
                <th>Decoration Price</th>
                <th>Fuel Type</th>
                <th>Model</th>
                <th>Seating Capacity</th>
                <th>Image</th>
                <th>Registration Date</th>
                <th>Action</th>  <!-- New column for delete button -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['vehicle_title']}</td>
                            <td>{$row['vehicle_brand']}</td>
                            <td>₹{$row['vehicle_price']}</td>
                            <td>{$row['fuel_type']}</td>
                            <td>{$row['model']}</td>
                            <td>{$row['seating_capacity']}</td>
                            <td><img src='/CRP/CRP/carrental/admin/img/Car_Decor/{$row['vehicle_image']}' alt='Car Image'></td>
                            <td>{$row['registration_date']}</td>
                            <td>
                                <button class='delete-btn' onclick=\"confirmDelete({$row['id']})\">Delete</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='no-data'>No cars available</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this vehicle?')) {
                window.location.href = 'delete_vehicle.php?id=' + id;
            }
        }
    </script>

</body>
</html>
