<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: fresh.php");
    exit();
}

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

// Initialize $user variable to store user details
$user = null;

// Check if 'id' is set in GET parameters to prevent errors if it's not
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Fetch data by ID
    $id = $_GET['id'];

    // Use prepared statement to securely fetch user data by ID
    $stmt = $conn->prepare("SELECT * FROM fresh WHERE user_id = ?"); // Modified query to use user_id instead of id
    $stmt->bind_param("s", $id); // Bind ID as string for user_id
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the user details if data is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<p>No data found for this User ID!</p>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<p>Please enter a User ID to search.</p>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Passport Management System</title>
    <link rel="stylesheet" href="profilestyle2.css">
</head>
<body>
    <div class="container">
        <h1>Applicant Profile</h1>

        <!-- Search form for user ID -->
        <!-- <form action="profile.php" method="GET" class="search-form">
            <label for="user-id">User ID:</label>
            <input type="text" id="user-id" name="id" placeholder="Enter User ID" required>
            <button type="submit">Search</button>
        </form> -->

        <!-- Display profile information only if user data is found -->
        <?php if ($user): ?>
            <div class="photo-container">
                <img src="uploads/<?php echo htmlspecialchars($user['photo']); ?>" alt="Profile Photo" class="profile-photo">
            </div>

            <div class="profile-info">
                <label>Applicant Number:</label>
                <span><?php echo htmlspecialchars($user['id']); ?></span>
            </div>

            <div class="profile-info">
                <label>Name:</label>
                <span><?php echo htmlspecialchars($user['name']); ?></span>
            </div>

            <div class="profile-info">
                <label>Date of Birth:</label>
                <span><?php echo htmlspecialchars($user['dob']); ?></span>
            </div>

            <div class="profile-info">
                <label>Address:</label>
                <span><?php echo htmlspecialchars($user['address']); ?></span>
            </div>

            <div class="profile-info">
                <label>Email:</label>
                <span><?php echo htmlspecialchars($user['email']); ?></span>
            </div>

            <div class="profile-info">
                <label>Phone Number:</label>
                <span><?php echo htmlspecialchars($user['phone']); ?></span>
            </div>

            <div class="profile-info">
                <label>Gender:</label>
                <span><?php echo htmlspecialchars($user['gender']); ?></span>
            </div>

            <div class="profile-info">
                <label>Passport Type:</label>
                <span><?php echo htmlspecialchars($user['passport_type']); ?></span>
            </div>

            <div class="profile-info">
                <label>Aadhar Card:</label>
                <span><a href="uploads/<?php echo htmlspecialchars($user['aadhar_card']); ?>" download>Aadhar Card</a></span>
            </div>

            <div class="profile-info">
                <label>Address Proof:</label>
                <span><a href="uploads/<?php echo htmlspecialchars($user['address_proof']); ?>" download>Address Proof</a></span>
            </div>


           <!-- Edit Button -->
           <div style="text-align: center; margin-top: 20px;">
                <a href="edit.html?userid=<?php echo htmlspecialchars($user['user_id']); ?>" 
                   style="text-decoration: none; padding: 10px 20px; background-color: blue; color: white; border-radius: 5px;">
                   Edit
                </a>
            </div>



        <?php else: ?>
            <p>No profile information available.</p>
        <?php endif; ?>
    </div>
</body>
</html>