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

    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            echo "<script>alert('Login successful!');</script>";
            echo  "<script>window.location.href = 'homepage.php';</script>";
            exit;
        } else {
         echo "<script>alert('Invalid username or password.');</script>";
         echo  "<script>window.location.href = 'login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password.');</script>";
        echo  "<script>window.location.href = 'login.html';</script>";
    }
    $stmt->close();
}

$conn->close();
?>