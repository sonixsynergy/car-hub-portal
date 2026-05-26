my-booking002.php

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Car Rental Portal - My Booking</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<style>
.decorated-heading {
    font-size: 24px;
    font-weight: bold;
    color: white;
    background: linear-gradient(45deg, #ff6b6b, #ffcc5c, #1dd1a1, #54a0ff, #5f27cd);
    padding: 12px 25px;
    border-radius: 10px;
    display: inline-block;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    border: 3px solid #fff;
    animation: glow 1.5s infinite alternate;
}

/* Glow effect */
@keyframes glow {
    0% { box-shadow: 0 0 10px rgba(255, 107, 107, 0.8); }
    100% { box-shadow: 0 0 20px rgba(95, 39, 205, 1); }
}

.thank-you-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background: linear-gradient(to right, #007BFF, #6C757D);
        color: #fff;
        font-family: Arial, sans-serif;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .thank-you-container h2 {
        margin-bottom: 15px;
    }
    .thank-you-container p {
        font-size: 16px;
        line-height: 1.5;
    }
</style>
</head>
<body>

<?php include('includes/header.php');?>

<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
      <center>
    <h5 class="decorated-heading">
        🎉 Decorated Car Booked 🚗
    </h5>
</center>
<!--our team contact you-->

<!--our team contact you close-->
<div class="thank-you-container">
    <h2>Thank You for Booking with Us!</h2>
    <p>
        We sincerely appreciate your trust in our decorated car rental service. Your booking has been confirmed, and we 
        are excited to provide you with a beautifully decorated car that suits your special occasion. 
    </p>
    <p>
        Our team is dedicated to ensuring a seamless and memorable experience for you. If you have any special requests 
        or need any modifications, feel free to contact us. 
    </p>
    <p>
        Safe travels, and we look forward to serving you again in the future!
    </p>
</div>
      </div>
    </div>
  </div>
</section>

<section class="user_profile inner_pages">
  <div class="container">
    <div class="profile_wrap">
    
      <div class="my_vehicles_list">
        <ul class="vehicle_listing">
<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT v.id, v.VehiclesTitle, v.VehiclesBrand, v.PricePerDay, v.FuelType, v.ModelYear, v.SeatingCapacity, v.Vimage1, v.RegistrationDate,
        b.BrandName, bk.FromDate, bk.ToDate, bk.message, bk.Status, DATEDIFF(bk.ToDate,bk.FromDate) as totaldays, bk.BookingNumber
        FROM tblbooking bk 
        JOIN tblvehicles v ON bk.VehicleId = v.id 
        JOIN tblbrands b ON b.id = v.VehiclesBrand 
        WHERE bk.userEmail=:useremail 
        ORDER BY v.PricePerDay ASC";
$query = $dbh -> prepare($sql);
$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<li>
    <h4 style="color:red">Booking No #<?php echo htmlentities($result->BookingNumber);?></h4>
    <div class="vehicle_img">
        <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>">
            <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image">
        </a>
    </div>
    <div class="vehicle_title">
        <h6>
            <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>">
                <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?>
            </a>
        </h6>
        <p><b>Fuel Type:</b> <?php echo htmlentities($result->FuelType);?> | <b>Model:</b> <?php echo htmlentities($result->ModelYear);?></p>
        <p><b>Seating Capacity:</b> <?php echo htmlentities($result->SeatingCapacity);?></p>
        <p><b>Registered On:</b> <?php echo htmlentities($result->RegistrationDate);?></p>
        <p><b>From</b> <?php echo htmlentities($result->FromDate);?> <b>To</b> <?php echo htmlentities($result->ToDate);?></p>
        <p><b>Message:</b> <?php echo htmlentities($result->message);?></p>
    </div>

    <div class="vehicle_status">
        <?php if($result->Status==1) { ?>
            <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
        <?php } else if($result->Status==2) { ?>
            <a href="#" class="btn outline btn-xs">Cancelled</a>
        <?php } else { ?>
            <a href="#" class="btn outline btn-xs">Not Confirmed Yet</a>
        <?php } ?>
    </div>
</li>

<h5 style="color:blue">Invoice</h5>
<table>
  <tr>
    <th>Car Name</th>
    <th>Fuel Type</th>
    <th>Model</th>
    <th>From Date</th>
    <th>To Date</th>
    <th>Total Days</th>
    <th>Rent / Day</th>
  </tr>
  <tr>
    <td><?php echo htmlentities($result->VehiclesTitle);?>, <?php echo htmlentities($result->BrandName);?></td>
    <td><?php echo htmlentities($result->FuelType);?></td>
    <td><?php echo htmlentities($result->ModelYear);?></td>
    <td><?php echo htmlentities($result->FromDate);?></td>
    <td><?php echo htmlentities($result->ToDate);?></td>
    <td><?php echo htmlentities($tds=$result->totaldays);?></td>
    <td><?php echo htmlentities($ppd=$result->PricePerDay);?></td>
  </tr>
  <tr>
    <th colspan="6" style="text-align:center;"> Grand Total</th>
    <th><?php echo htmlentities($tds*$ppd);?></th>
  </tr>
</table>
<hr />

<?php }} else { ?>
    <h5 align="center" style="color:red"></h5>
<?php } ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php');?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
</body>
</html>
<?php } ?>
