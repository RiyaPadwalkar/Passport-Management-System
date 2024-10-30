<?php
// Start the session (optional, if you need to use session variables)
session_start();

$user_id = $_SESSION['user_id'];
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";  // Create this database in phpMyAdmin

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $passportNumber = $_POST['passport-number'];
    $type = $_POST['type'];
    $cardNumber = $_POST['card-number'];
    $expiryDate = $_POST['expiry-date'];
    $cvv = $_POST['cvv'];

    // Determine the amount based on the type
    $amount = ($type === 'Fresh_Passport') ? 100 : 50;

    // Insert payment information into the database
    $sql = "INSERT INTO payments (user_id, name, passport_number, type, amount, card_number, expiry_date, cvv)
            VALUES ('$user_id', '$name', '$passportNumber', '$type', '$amount', '$cardNumber', '$expiryDate', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Payment successful!');</script>";
        echo  "<script>window.location.href = 'homepage.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" type="text/css" href="payment.css">
    <script src="payment.js"></script>
</head>
<body>
    <!-- Payment Page -->
    <h2>Payment Page</h2>
    <p>Your User ID: <?php echo htmlspecialchars($user_id); ?></p>
    
    <!-- Form -->
    <form id="PaymentForm" action="payment.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="passport-number">Passport Number:</label>
        <input type="text" id="passport-number" name="passport-number"><br><br>
        
        <label for="Type">Type:</label>
        <select id="type" name="type">
            <option value="">Select Type</option>
            <option value="Fresh_Passport">Fresh Passport</option>
            <option value="Renewal">Renewal</option>
        </select><br><br>
        
        <label for="card-number">Card Number:</label>
        <input type="text" id="card-number" name="card-number"><br><br>
        
        <label for="expiry-date">Expiry Date:</label>
        <input type="date" id="expiry-date" name="expiry-date"><br><br>
        
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv"><br><br>
        
        <input type="submit" id="submit" value="Pay">
    </form>
</body>
</html>
