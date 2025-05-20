<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Fetch unique brands for filter dropdown
$brands = mysqli_query($conn, "SELECT DISTINCT car_brand FROM cars");

// Handle filters
$where = [];
if (!empty($_GET['brand'])) {
    $brand = mysqli_real_escape_string($conn, $_GET['brand']);
    $where[] = "car_brand = '$brand'";
}
if (!empty($_GET['price_range'])) {
    $price_range = $_GET['price_range'];
    if ($price_range == 'under5') {
        $where[] = "price <= 500000";
    } elseif ($price_range == '5to10') {
        $where[] = "price > 500000 AND price <= 1000000";
    } elseif ($price_range == 'above10') {
        $where[] = "price > 1000000";
    }
}
$where_sql = $where ? "WHERE " . implode(" AND ", $where) : "";

$cars = mysqli_query($conn, "SELECT * FROM cars $where_sql");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home - Car Dealership</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    .form-select, .btn {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>

<!-- Bootstrap Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">JC Motors</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'home.php') echo 'active'; ?>" href="home.php">Home</a>
       
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'happy-customers.php') echo 'active'; ?>" href="happy-customers.php">Happy Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'active'; ?>" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'location.php') echo 'active'; ?>" href="location.php">Location</a>
        </li>
      </ul>
      <div class="d-flex">
        <a href="sell-car.php" class="btn btn-outline-light me-2">Sell Your Car</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h1 class="text-center mb-5">Welcome, JC Motors <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <form class="row g-2" method="GET">
      <div class="col-sm-5 col-md-4">
        <select name="brand" class="form-select">
          <option value="">All Brands</option>
          <?php while ($b = mysqli_fetch_assoc($brands)) { ?>
            <option value="<?php echo htmlspecialchars($b['car_brand']); ?>" <?php if (isset($_GET['brand']) && $_GET['brand'] == $b['car_brand']) echo 'selected'; ?>>
              <?php echo htmlspecialchars($b['car_brand']); ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="col-sm-5 col-md-4">
        <select name="price_range" class="form-select">
          <option value="">All Prices</option>
          <option value="under5" <?php if (isset($_GET['price_range']) && $_GET['price_range'] == 'under5') echo 'selected'; ?>>Up to ₹5,00,000</option>
          <option value="5to10" <?php if (isset($_GET['price_range']) && $_GET['price_range'] == '5to10') echo 'selected'; ?>>₹5,00,001 - ₹10,00,000</option>
          <option value="above10" <?php if (isset($_GET['price_range']) && $_GET['price_range'] == 'above10') echo 'selected'; ?>>Above ₹10,00,000</option>
        </select>
      </div>
      <div class="col-sm-2 col-md-2">
        <button type="submit" class="btn btn-success w-100">Filter</button>
      </div>
    </form>
  </div>

  <h3 class="mb-4">Available Cars for Sale</h3>
  <div class="row">
    <?php while ($car = mysqli_fetch_assoc($cars)) { 
      $imagePath = 'uploads/' . htmlspecialchars($car['image']);
      $altText = htmlspecialchars($car['car_brand'] . ' ' . $car['car_model']);
    ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <a href="car-details.php?id=<?php echo $car['id']; ?>">
          <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="<?php echo $altText; ?>">
        </a>
        <div class="card-body">
          <h5 class="card-title"><?php echo $altText; ?></h5>
          <p class="card-text">
            <strong>Year:</strong> <?php echo htmlspecialchars($car['year']); ?><br>
            <strong>Price:</strong> ₹<?php echo number_format($car['price']); ?><br>
            <strong>Contact:</strong> <?php echo htmlspecialchars($car['contact']); ?>
          </p>
          <p class="card-text"><em><?php echo htmlspecialchars($car['description']); ?></em></p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
