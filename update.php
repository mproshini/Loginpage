<?php
// Get user input from the form
$Firstname = isset($_POST['Firstname']) ? $_POST['Firstname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';
$dob = isset($_POST['dob']) ? $_POST['dob'] : '';

if (!empty($_POST)) {
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

    // Update user information in the database
    $sql = "UPDATE users SET email='$email', password='$password', contact_no='$contact_no', dob='$dob' WHERE Firstname='$Firstname'";
    if ($conn->query($sql) === TRUE) {
        // Display success message
        echo "Profile updated for " . $Firstname;
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    // Close connection
    $conn->close();

    // Create an associative array with the user's profile information
    $userData = array(
        'firstname' => $Firstname,
        'email' => $email,
        'password' => $password,
        'contact_no' => $contact_no,
        'dob' => $dob
    );

    // Convert the array to JSON format
    $jsonData = json_encode($userData);

    // Write the JSON data to a file
    $filename = 'user_profile.json';
    $file = fopen($filename, 'w');
    fwrite($file, $jsonData);
    fclose($file);

} // end of if (!empty($_POST))
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="stylesheet/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

    <h1>Update Profile</h1>

    <form method="POST" action="">
        <label for="Firstname">First Name:</label>
        <input type="text" id="Firstname" name="Firstname" value="<?php echo $Firstname; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>" required><br>

        <label for="contact_no">Contact Number:</label>
        <input type="tel" id="contact_no" name="contact_no" value="<?php echo $contact_no; ?>" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required><br>

        <input type="submit" value="Update">
    </form>

    <?php
    // Calculate age based on date of birth
    if (!empty($dob)) {
        $dob_timestamp = strtotime($dob);
        $age = floor((time() - $dob_timestamp) / 31556926);
        echo "Age: " . $age;
    }
    ?>



    <!-- Link to go back to the login page -->
<div class="login-button-container">
  <a href="login.html" class="login-button">Back to Login</a>
</div>

<script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="script.js"></script>

</body>
</html>