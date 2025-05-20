


<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Contact Us - JC Motors</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Contact Us</h2>
  <p>Have questions? Reach out to us using the form below.</p>
  <form>
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Message</label>
      <textarea class="form-control" rows="4" required></textarea>
    </div>
    <button class="btn btn-primary">Send</button>
  </form>
</div>
</body>
</html>
