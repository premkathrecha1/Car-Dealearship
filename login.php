
<!DOCTYPE html>
<html>
<head>
  <title>Login - JC MOTORS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-box">
    <img src="uploads/logo.png" alt="JC MOTORS Logo" class="logo">
    <h2>Welcome to <br>JC MOTORS</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>

    <?php
    session_start();
    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST['username'];
      $password = md5($_POST['password']);

      $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
      } else {
        echo "<p style='color:red;'>Invalid username or password.</p>";
      }
    }
    ?>
  </div>
</body>
</html>
