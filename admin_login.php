<?php
$servername = "localhost";
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password
$dbname = "admin_db"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$admin_username = $_POST['username'];
$admin_password = $_POST['password'];

// Check if the username and password match the database
$sql = "SELECT * FROM admins WHERE username = '$admin_username' AND password = '$admin_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Redirect to the database page on successful login
    header("Location: database.html");
    exit(); // Stop further script execution
} else {
    echo "Invalid username or password.";
}

$conn->close();
?>
