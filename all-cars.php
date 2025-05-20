
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
include 'navbar.php';

$cars = mysqli_query($conn, "SELECT * FROM cars");
?>
<!DOCTYPE html>
<html>
<head>
  <title>All Cars - JC Motors</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>All Cars in Our Showroom</h2>
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
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
</body>
</html>
