

<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "cars"; // or your actual database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
