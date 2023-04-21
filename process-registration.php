<?php
// Get form data
$Firstname = $_POST["Firstname"];
$email = $_POST["email"];
$password = $_POST["password"];
$contactNo = $_POST["contact-no"];

// Validate form data
if ($Firstname == "" || $email == "" || $password == "" || $contactNo == "") {
  echo "Please fill in all required fields.";
  return;
}

// Hash password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare statement to insert data into users table
$stmt = $conn->prepare("INSERT INTO users (Firstname, email, password, contact_no) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $Firstname, $email, $passwordHash, $contactNo);
$stmt->execute();

// Check if data was inserted successfully
if ($stmt->affected_rows > 0) {
  echo "Registration successful.";
} else {
  echo "Registration failed.";
}

$stmt->close();
$conn->close();

// Store user information in JSON file
$userData = array(
  "Firstname" => $Firstname,
  "email" => $email,
  "contact_no" => $contactNo
);

$file = fopen("users.json", "a+");
fwrite($file, json_encode($userData) . "\n");
fclose($file);
?>