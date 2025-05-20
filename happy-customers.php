<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Happy Customers - JC Motors</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .review-card {
      height: 220px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 12px;
      background: #fff;
      padding: 20px;
      transition: transform 0.3s ease;
    }
    .review-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .car-model {
      font-weight: 700;
      font-size: 1.2rem;
      color: #007bff;
      margin-bottom: 10px;
    }
    .review-text {
      flex-grow: 1;
      font-style: italic;
      font-size: 1.05rem;
      color: #333;
      margin-bottom: 10px;
    }
    .review-author {
      text-align: right;
      font-weight: 600;
      color: #555;
      font-size: 1rem;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4 text-center">Happy Customers</h2>
  <p class="text-center mb-5">We value every customer! Here's what some of them have to say about their cars and experience:</p>
  <div class="row g-4">
    <?php 
    $reviews = [
      ["Honda Civic 2020", "Amazing service and the car runs smoothly. Love the condition!","Raj Patel"],
      ["Toyota Corolla 2019", "Smooth buying process and the car exceeded my expectations.","Neha Sharma"],
      ["Ford Mustang 2021", "Professional team and excellent quality vehicle.","Ali Khan"],
      ["Hyundai Tucson 2018", "The car performs great and paperwork was hassle-free.","Sana Mehta"],
      ["BMW X3 2020", "Friendly staff and I got a very fair price for this luxury car.","Rohit Singh"],
      ["Maruti Swift 2017", "Best place to buy used cars, very reliable.","Pooja Desai"],
      ["Audi A4 2019", "Fantastic experience, the car is flawless!","Vikram Joshi"],
      ["Kia Seltos 2021", "Customer support was outstanding throughout the purchase.","Ayesha Siddiqui"],
      ["Tesla Model 3 2022", "Highly satisfied with my new electric car.","Karan Verma"],
      ["Honda CR-V 2019", "Showroom is clean and the staff are very helpful.","Meera Nair"],
      ["Volkswagen Polo 2016", "Fair pricing and no hidden charges. Great value.","Sameer Malik"],
      ["Mahindra Thar 2020", "Got a great deal and love the rugged design.","Isha Reddy"],
      ["Jeep Compass 2018", "Recommend JC Motors to all my friends and family.","Harsh Gupta"],
      ["Toyota Fortuner 2021", "Quick delivery and excellent follow-up service.","Divya Kapoor"],
      ["Mercedes-Benz C-Class 2020", "Top-notch cars and amazing service quality.","Aditya Sharma"]
    ];

    foreach($reviews as $review) {
      echo '<div class="col-md-4">';
      echo '  <div class="review-card">';
      echo '    <div class="car-model">' . htmlspecialchars($review[0]) . '</div>';
      echo '    <p class="review-text">"' . htmlspecialchars($review[1]) . '"</p>';
      echo '    <small class="review-author">– ' . htmlspecialchars($review[2]) . '</small>';
      echo '  </div>';
      echo '</div>';
    }
    ?>
  </div>
</div>
</body>
</html>
