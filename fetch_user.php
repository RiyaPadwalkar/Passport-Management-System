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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];

    // Prepare SQL query to check both tables
    $sql = "
        SELECT 'fresh' AS source, * FROM fresh WHERE userid=?
        UNION ALL
        SELECT 'renewal' AS source, * FROM renewal WHERE userid=?
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userid, $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row; // Collect rows from both tables
        }
        echo json_encode($rows); // Return all rows found
    } else {
        echo json_encode(["error" => "No user found in any table."]);
    }

    $stmt->close();
    $conn->close();
}
?>
