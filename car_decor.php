<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Car Rental Portal | Car Listing</title>


<style>
.newsletter-form {
    max-width: 250px;
    margin: 0 auto;
    padding: 10px;
}

.newsletter-form .form-group {
    margin-bottom: 5px;
}

.newsletter-form input {
    padding: 5px;
    font-size: 14px;
}

.newsletter-form button {
    padding: 5px 10px;
    font-size: 14px;
}
</style>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>


<!--Header-->
<!-- Header -->
<header>
  <div class="default-header text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="logo text-center">
            <a href="index.php">
              <img class="logo" src="assets/images/logo.png" alt="image" id="logo"/>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" class="navbar-toggle collapsed"> 
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="page.php?type=aboutus">About Us</a></li>
          <li><a href="car-listing.php">Car Listing</a></li>
          <li><a href="car_decor.php">Car Decor</a></li>
          <li><a href="page.php?type=faqs">FAQs</a></li>
          <li><a href="contact-us.php">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- JavaScript Enhancements -->
<script>
  // Logo Animation
  document.getElementById("logo").addEventListener("mouseover", function() {
    this.style.transform = "scale(1.1)";
    this.style.transition = "0.3s";
  });
  document.getElementById("logo").addEventListener("mouseout", function() {
    this.style.transform = "scale(1)";
  });
  
  // Search Bar Toggle
  document.getElementById("search_toggle").addEventListener("click", function() {
    let searchForm = document.getElementById("header-search-form");
    if (searchForm.style.display === "block") {
      searchForm.style.display = "none";
    } else {
      searchForm.style.display = "block";
      searchForm.style.animation = "fadeIn 0.5s";
    }
  });

  // Mobile Menu Slide
  document.getElementById("menu_slide").addEventListener("click", function() {
    let nav = document.getElementById("navigation");
    if (nav.style.display === "block") {
      nav.style.display = "none";
    } else {
      nav.style.display = "block";
      nav.style.animation = "slideDown 0.5s";
    }
  });
</script>

<style>
  /* Enhancements */
  .default-header {
    text-align: center;
  }

  .logo {
    display: block;
    margin: 0 auto;
  }

  #header-search-form {
    display: none;
    position: absolute;
    right: 10px;
    top: 50px;
    background: white;
    padding: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    background: white;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  }
  #user-menu:hover + .dropdown-menu {
    display: block;
    animation: fadeIn 0.3s;
  }
  

  /* Animations */
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  @keyframes slideDown {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }
</style>

<!--Header-->


<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Car Decoration</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Car Decoration</li>
      </ul>
    </div>
  </div>
  <div class="dark-overlay"></div>
</section>

<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <h2><i class="fa fa-gift" aria-hidden="true"></i> Available Decoration Cars</h2>
          </div>
        </div>

<?php
$host = 'localhost';
$dbname = 'car_rental';
$username = 'root';
$password = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$sql = "SELECT COUNT(id) as total FROM vehicles";
$query = $dbh->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$cnt = $result->total;
?>
<p><span><?php echo htmlentities($cnt); ?> Listings</span></p>

<?php
$sql = "SELECT id, vehicle_title, vehicle_brand, vehicle_price, fuel_type, model, seating_capacity, vehicle_image FROM vehicles";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    foreach ($results as $result) {  
?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img">
            <img src="admin/img/Car_Decor/<?php echo htmlentities($result->vehicle_image); ?>" class="img-responsive" alt="Image" />
          </div>
          <div class="product-listing-content">
            <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                <?php echo htmlentities($result->vehicle_title); ?>
              </a></h5>
            <p class="list-price">₹<?php echo htmlentities($result->vehicle_price); ?> Decor Price</p>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlentities($result->seating_capacity); ?> seats</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo htmlentities($result->model); ?> model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i> <?php echo htmlentities($result->fuel_type); ?></li>
            </ul>
            <a href="Decor_detail_view.php?vhid=<?php echo htmlentities($result->id); ?>" class="btn">Book Now <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
<?php 
    } 
} else {
    echo "<p>No vehicles found.</p>";
}
?>


<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer-->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
