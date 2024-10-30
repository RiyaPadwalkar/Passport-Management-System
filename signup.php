<?php
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "your_database";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $checkUser = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose another.')</script>";
        echo  "<script>window.location.href = 'login.html';</script>";
    } else {
        $userId = $username.rand(1,1000); // Generate a unique user ID
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (user_id, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $userId, $username, $hashedPassword);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $userId; // Store user ID in session
            echo "<script>alert('Signup successful!');</script>";
            echo  "<script>window.location.href = 'homepage.php';</script>";
            exit;
        } else {
            echo "Error: Could not execute query. Please try again later.";
        }
        $stmt->close();
    }
    $checkUser->close();
}
$conn->close();
?>
