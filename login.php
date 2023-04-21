<!-- login.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Profile page</title>
    <link rel="stylesheet" href="style.scss">

</head>
<body>

	<h1>Profile Page</h1>


    <?php
// Connect to the database
$host = "localhost";
$username = "root";
$password= "";
$dbname = "user_db";
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the form
$firstname = $_POST['Firstname'];
$password = $_POST['password'];

// Retrieve user information from the database based on input
$sql = "SELECT * FROM users WHERE Firstname = '$firstname' AND password = '$password'";
$result = $conn->query($sql);

// Display user information on the page if user is found
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Welcome! ".$row["Firstname"] ."<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Contact No: " . $row["contact_no"] . "<br><br>";
    }
} else {
    echo "User not found or invalid credentials.";
}

// Close connection
$conn->close();
?>


<div class="login-button-container">
      <a href="update.php" class="login-button">Click here to update your profile?</a>
    </div>

</body>
</html>