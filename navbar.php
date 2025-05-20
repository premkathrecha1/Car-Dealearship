
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">



  <div class="container">
    <a class="navbar-brand" href="home.php">JC Motors</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>" href="home.php">Home</a>
        </li>


        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'happy-customers.php' ? 'active' : ''; ?>" href="happy-customers.php">Happy Customers</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" href="contact.php">Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'location.php' ? 'active' : ''; ?>" href="location.php">Location</a>
        </li>

      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item me-2">
          <a class="btn btn-primary" href="sell-car.php">Sell Your Car</a>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
          
          <li class="nav-item">
            <a class="btn btn-danger" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="btn btn-success" href="login.php">Login</a>
          </li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
