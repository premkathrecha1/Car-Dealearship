<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter_brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$filter_price = isset($_GET['price']) ? $_GET['price'] : '';

$query = "SELECT * FROM cars WHERE CONCAT(car_brand, ' ', car_model, description) LIKE ?";
$params = ["%$search%"];

if (!empty($filter_brand)) {
    $query .= " AND car_brand = ?";
    $params[] = $filter_brand;
}
if (!empty($filter_price)) {
    $query .= " AND price <= ?";
    $params[] = $filter_price;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Car Dealership</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <div class="text-end mb-3">
        <a href="sell-car.php" class="btn btn-primary">Sell Your Car</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
        </div>
        <div class="col-md-3">
            <select name="brand" class="form-select">
                <option value="">Filter by Brand</option>
                <?php
                $brands = $conn->query("SELECT DISTINCT car_brand FROM cars")->fetchAll(PDO::FETCH_COLUMN);
                foreach ($brands as $brand) {
                    echo '<option value="' . htmlspecialchars($brand) . '"' . ($filter_brand == $brand ? ' selected' : '') . '>' . htmlspecialchars($brand) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="price" class="form-select">
                <option value="">Filter by Max Price</option>
                <option value="500000" <?php if($filter_price=='500000') echo 'selected'; ?>>Up to ₹5 Lakhs</option>
                <option value="1000000" <?php if($filter_price=='1000000') echo 'selected'; ?>>Up to ₹10 Lakhs</option>
                <option value="2000000" <?php if($filter_price=='2000000') echo 'selected'; ?>>Up to ₹20 Lakhs</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Apply</button>
        </div>
    </form>

    <div class="row">
        <?php if (count($cars) === 0): ?>
            <p class="text-center">No cars found.</p>
        <?php else: ?>
            <?php foreach ($cars as $car): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <a href="car-details.php?id=<?php echo $car['id']; ?>">
                            <img src="uploads/<?php echo htmlspecialchars($car['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($car['car_brand'] . ' ' . $car['car_model']); ?>" style="height: 200px; object-fit: cover; border-radius: 10px;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($car['car_brand'] . ' ' . $car['car_model']); ?></h5>
                            <p class="card-text">
                                <strong>Year:</strong> <?php echo htmlspecialchars($car['year']); ?><br>
                                <strong>Price:</strong> ₹<?php echo number_format($car['price']); ?><br>
                                <strong>Contact:</strong> <?php echo htmlspecialchars($car['contact']); ?>
                            </p>
                            <p class="card-text"><em><?php echo htmlspecialchars($car['description']); ?></em></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
