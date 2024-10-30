<?php
session_start(); // Start session if it hasn’t been already

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection settings
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is empty
$dbname = "your_database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete user
$userid = $_SESSION['user_id'];
$del = "DELETE FROM users WHERE user_id = '$userid'";

if ($conn->query($del) === TRUE) {
    session_destroy(); // End session after successful deletion
    
    echo "<h1>Logout Successful</h1>
          <p>You have been successfully logged out of the Passport Management System.</p>
          <p>Thank you for using our services.</p>";

    echo "<script>setTimeout(function() {
                window.location.href = 'homepage.php';
            }, 3000);</script>"; // Redirect after 3 seconds
} else {
    echo "Error: " . $conn->error;
}

$conn->close(); // Close the database connection
?>
