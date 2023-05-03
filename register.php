<?php
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
$email = $_POST['email'];
$password = $_POST['password'];
$contact_no = $_POST['contact-no'];

// Store user information in MySQL database
$sql = "INSERT INTO users (username, email, password, contact_no)
        VALUES ('$username', '$email', '$password', '$contact_no')";

if ($conn->query($sql) === TRUE) {
  echo "User registered successfully";
} else {
  echo "Error: " . $sql . "<br>";
}

// Store user information in JSON file
$data = array(
  'username' => $username,
  'email' => $email,
  'password' => $password,
  'contact_no' => $contact_no
);

$file = 'users.json';

if (file_exists($file)) {
  $json = file_get_contents($file);
  $array = json_decode($json, true);
} else {
  $array = array();
}

array_push($array, $data);

$json = json_encode($array);
file_put_contents($file, $json);

$conn->close();
?>
