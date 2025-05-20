<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = mysqli_real_escape_string($conn, $_POST['car_brand']);
    $model = mysqli_real_escape_string($conn, $_POST['car_model']);
    $year = intval($_POST['year']);
    $price = intval($_POST['price']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $uploadDir = "uploads/";
    $filenames = [];

    // Handle up to 5 image uploads
    for ($i = 1; $i <= 5; $i++) {
        $inputName = "image" . $i;
        if (!empty($_FILES[$inputName]['name'])) {
            $filename = basename($_FILES[$inputName]["name"]);
            $targetFile = $uploadDir . time() . "_" . $filename;
            if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile)) {
                $filenames[$i] = $targetFile;
            } else {
                $filenames[$i] = "";
            }
        } else {
            $filenames[$i] = "";
        }
    }

    $sql = "INSERT INTO cars (car_brand, car_model, year, price, contact, description, image, image2, image3, image4, image5)
            VALUES ('$brand', '$model', $year, $price, '$contact', '$description',
                    '{$filenames[1]}', '{$filenames[2]}', '{$filenames[3]}', '{$filenames[4]}', '{$filenames[5]}')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Car posted successfully!'); window.location.href = 'home.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sell Your Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Sell Your Car</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="car_brand" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Model</label>
            <input type="text" name="car_model" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price (in ₹)</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contact Info</label>
            <input type="text" name="contact" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Car Images (up to 5)</label><br>
            <input type="file" name="image1" accept="image/*" class="form-control mb-2">
            <input type="file" name="image2" accept="image/*" class="form-control mb-2">
            <input type="file" name="image3" accept="image/*" class="form-control mb-2">
            <input type="file" name="image4" accept="image/*" class="form-control mb-2">
            <input type="file" name="image5" accept="image/*" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit Car</button>
        <a href="home.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
</body>
</html>
