<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: fresh.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch details if userid is provided via GET request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Fetch details from the fresh table
    $sql = "SELECT * FROM fresh WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo json_encode(["success" => true, "user" => $user]);
    } else {
        echo json_encode(["success" => false]);
    }
    $stmt->close();
    $conn->close();
    exit();
}

// Handle form submission for updating user details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // $tables = ["fresh", "renewal"];
	$tables = ["fresh"];
    $success = true;

    foreach ($tables as $table) {
        $sql = "UPDATE $table SET name=?, dob=?, address=?, email=?, phone=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $dob, $address, $email, $phone, $userid);

        if (!$stmt->execute()) {
            $success = false;
            echo "Error updating record in $table: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // if ($success) {
    //     echo "Record updated successfully across all tables.";
    // }


	if ($success) {
        echo "<script>alert('Record updated successfully across all tables.'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('An error occurred. Please try again later.');</script>";
    }

    $conn->close();
}
?>
