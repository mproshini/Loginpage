<?php
session_start();

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

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if user exists in database
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// User is authenticated, set session variables and redirect to profile page
$row = $result->fetch_assoc();
$_SESSION['username'] = $row['username'];
$_SESSION['email'] = $row['email'];
$_SESSION['contact_no'] = $row['contact_no'];
header("Location: profile.php");
} else {
// User is not authenticated, redirect to login page with error message
$_SESSION['login_error'] = "Invalid username or password";
header("Location: login.php");
}

$conn->close();
?>




