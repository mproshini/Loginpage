<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: login.html');
  exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from MySQL database
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $userData = array(
    'username' => $row['username'],
    'email' => $row['email'],
    'contact_no' => $row['contact_no']
  );
  echo json_encode($userData);
} else {
  echo "User not found.";
}

$conn->close();
?>
