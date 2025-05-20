<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the user is admin
$user = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT is_admin FROM users WHERE username = '$user'");
$row = mysqli_fetch_assoc($result);



// Fetch brand-wise car count
$brandData = mysqli_query($conn, "SELECT car_brand, COUNT(*) AS total FROM cars GROUP BY car_brand");
$brands = [];
$counts = [];

while ($row = mysqli_fetch_assoc($brandData)) {
    $brands[] = $row['car_brand'];
    $counts[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      display: flex;
    }
    .sidebar {
      width: 220px;
      background: #343a40;
      color: white;
      height: 100vh;
      padding-top: 20px;
      position: fixed;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .main {
      margin-left: 220px;
      padding: 30px;
      width: 100%;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h4 class="text-center">JC Motors</h4>
  <a href="home.php">Home</a>
  <a href="dashboard.php">Dashboard</a>
  <a href="sell-car.php">Sell Car</a>
  <a href="logout.php">Logout</a>
</div>

<div class="main">
  <h2 class="mb-4">Admin Dashboard</h2>

  <div class="card p-4 shadow-sm">
    <h5>Brand-wise Car Distribution</h5>
    <canvas id="brandChart" width="400" height="200"></canvas>
  </div>
</div>

<script>
  const ctx = document.getElementById('brandChart');
  const brandChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($brands); ?>,
      datasets: [{
        label: 'Cars by Brand',
        data: <?php echo json_encode($counts); ?>,
        backgroundColor: [
          '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#fd7e14'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true
    }
  });
</script>

</body>
</html>
