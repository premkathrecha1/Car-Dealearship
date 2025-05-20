<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid car ID.";
    exit();
}

$car_id = intval($_GET['id']);
$sql = "SELECT * FROM cars WHERE id = $car_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
    echo "Car not found.";
    exit();
}

$car = mysqli_fetch_assoc($result);
$imagePath = 'uploads/' . (!empty($car['image']) ? htmlspecialchars($car['image']) : 'default.jpg');
$altText = htmlspecialchars($car['car_brand'] . ' ' . $car['car_model']);
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $altText; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
    }

    .full-banner {
      position: relative;
      height: 100vh;
      width: 100%;
      background-image: url('uploads/banner.jpg');
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .overlay-content {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      max-width: 1000px;
      width: 90%;
      padding: 30px;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      align-items: center;
      z-index: 2;
    }

    .overlay-content img {
      max-width: 100%;
      border-radius: 15px;
    }

    .car-info {
      flex: 1;
      min-width: 280px;
    }

    .car-info h2 {
      font-size: 2rem;
      margin-bottom: 15px;
    }

    .btn-back {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 3;
    }

    @media (max-width: 768px) {
      .overlay-content {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <!-- Back Button -->
  <a href="home.php" class="btn btn-dark btn-back">← Back</a>

  <!-- Full Banner Section -->
  <div class="full-banner">
    <div class="overlay-content">
      <div class="car-img col-md-6">
        <img src="<?php echo $imagePath; ?>" alt="<?php echo $altText; ?>">
      </div>
      <div class="car-info col-md-6">
        <h2><?php echo $altText; ?></h2>
        <p><strong>Year:</strong> <?php echo htmlspecialchars($car['year']); ?></p>
        <p><strong>Price:</strong> ₹<?php echo number_format($car['price']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($car['contact']); ?></p>
        <p><strong>Description:</strong><br><?php echo nl2br(htmlspecialchars($car['description'])); ?></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
