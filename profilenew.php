<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data by ID
$id = $_GET['id'];
$sql = "SELECT * FROM fresh WHERE id = $id";
$result = $conn->query($sql);
$user = null;

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No data found!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Passport Management System</title>
    <link rel="stylesheet" href="profilenew.css">
</head>
<body>
    <div class="container">
        <!-- Profile Photo at the top -->
        <h1>Applicant Profile</h1>

        <div class="photo-container">
            <img src="uploads/<?php echo $user['photo']; ?>" alt="Profile Photo" class="profile-photo">
        </div>

        <div class="profile-info">
            <label>Applicant Number:</label>
            <span><?php echo $user['id']; ?></span>
        </div>

        <div class="profile-info">
            <label>Name:</label>
            <span><?php echo $user['name']; ?></span>
        </div>

        <div class="profile-info">
            <label>Date of Birth:</label>
            <span><?php echo $user['dob']; ?></span>
        </div>

        <div class="profile-info">
            <label>Address:</label>
            <span><?php echo $user['address']; ?></span>
        </div>

        <div class="profile-info">
            <label>Email:</label>
            <span><?php echo $user['email']; ?></span>
        </div>

        <div class="profile-info">
            <label>Phone Number:</label>
            <span><?php echo $user['phone']; ?></span>
        </div>

        <div class="profile-info">
            <label>Gender:</label>
            <span><?php echo $user['gender']; ?></span>
        </div>

        <div class="profile-info">
            <label>Passport Type:</label>
            <span><?php echo $user['passport_type']; ?></span>
        </div>

        <div class="profile-info">
            <label>Aadhar Card:</label>
            <span><a href="uploads/<?php echo $user['aadhar_card']; ?>" download>Aadhar Card</a></span>
        </div>

        <div class="profile-info">
            <label>Address Proof:</label>
            <span><a href="uploads/<?php echo $user['address_proof']; ?>" download>Address Proof</a></span>
        </div>
    </div>
</body>
</html>
